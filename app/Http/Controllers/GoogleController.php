<?php



namespace App\Http\Controllers;

use App\Models\AllowedUsers;
use App\Models\ChatGpt;

use App\Models\User;

use Carbon\Carbon;

use Exception;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Laravel\Socialite\Facades\Socialite;



class GoogleController extends Controller

{

    public function __construct()

    {

        $this->middleware('guest')->except('logout');
    }



    protected $providers = [

        'google'

    ];



    public function show()

    {

        return view('login');
    }



    public function redirectToProvider($driver)

    {

        if (!$this->isProviderAllowed($driver)) {

            return $this->sendFailedResponse("{$driver} is not currently supported");
        }



        try {

            return Socialite::driver($driver)->redirect();
        } catch (Exception $e) {

            return $this->sendFailedResponse($e->getMessage());
        }
    }





    public function handleProviderCallback($driver)

    {

        try {

            $user = Socialite::driver($driver)->user();
            $allowedUsers = AllowedUsers::get();
            $emailFound = false;
            foreach ($allowedUsers as $key => $value) {
                if (strtolower($value->email) == strtolower($user->email)) {
                    $emailFound = true;
                    break;
                }
            }
            if ($emailFound) {
            } else {
                Auth::logout();
                return redirect()->route('signup')->with('error', 'Email not found in Google sheet. Contact admin for more details. Thank you!');
            }
        } catch (Exception $e) {

            return $this->sendFailedResponse($e->getMessage());
        }





        return empty($user->email)

            ? $this->sendFailedResponse("No email id returned from {$driver} provider.")

            : $this->loginOrCreateAccount($user, $driver);
    }



    protected function sendSuccessResponse()

    {

        return redirect()->intended('/');
    }



    protected function sendFailedResponse($msg = null)

    {

        return redirect()->route('social.login')

            ->withErrors(['error' => $msg ?: 'Unable to login, try with another provider to login.']);
    }



    protected function loginOrCreateAccount($providerUser, $driver)

    {

        $user = User::where('email', $providerUser->getEmail())->first();

        $user_found = User::where('email', $providerUser->getEmail())->count();

        if ($user_found == 1) {

            Auth::login($user);

            User::where('id', Auth::user()->id)->update(['last_login' => Carbon::now()]);

            if (Auth::user()->code == true) {

                return redirect()->route('VerifyUser');
            }

            $totalToken = ChatGpt::where('id', 1)->first();

            $user_tokens = User::find(Auth::user()->id);

            if ($user_tokens->lastDate != Carbon::now()->format('Y-m-d')) {

                $user_tokens->lastTokens = $totalToken->default_tokens;

                $user_tokens->lastDate = Carbon::now()->format('Y-m-d');

                $user_tokens->save();
            }

            return redirect()->route('Home');
        }

        if ($providerUser) {

            $totalToken = ChatGpt::where('id', 1)->first();

            $user = new User();

            $user->name = $providerUser->name;

            $user->email = $providerUser->email;

            $user->google_id = $providerUser->id;

            $user->access_token = $providerUser->token;

            $user->lastDate = Carbon::now()->format('Y-m-d');

            $user->lastTokens = $totalToken->default_tokens;

            $user->password = Hash::make('12345678');

            $user->role = "User";

            $user->save();

            $user->code = null;

            Auth::login($user, true);

            return redirect()->route('Home');
        }
    }



    private function isProviderAllowed($driver)

    {

        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }
}
