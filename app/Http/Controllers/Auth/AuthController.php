<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\AllowedUsers;
use App\Models\ChatGpt;
use App\Models\DailyUserTokens;
use App\Models\History;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller

{
    public function ShowHomePage()
    {
        if (Auth::user()->role == "User") {
            if (Auth::check() == true) {
                $totalToken = ChatGpt::where('id', 1)->first();
                $user_tokens = User::find(Auth::user()->id);
                if ($user_tokens->lastDate != Carbon::now()->format('Y-m-d')) {
                    $user_tokens->lastTokens = $totalToken->default_tokens;
                    $user_tokens->lastDate = Carbon::now()->format('Y-m-d');
                    $user_tokens->save();
                }
                $name = "social-media-ad-copy-creation";
                return view('frontend.index', compact('name'));
            } else {
                return redirect()->route('login');
            }
        }  else {
            return redirect()->route('admin.dashboard');
        }
    }
    public function history()
    {
        if (Auth::user()->role == "User") {
            if (Auth::check() == true) {
                $name = "history";
                $history = History::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
                return view('frontend.history', compact('name', 'history'));
            } else {
                return redirect()->route('login');
            }
        }
         //else {

        //     return redirect()->back()->with('error', 'Role is invalid!');

        // } 
        else {
            return redirect()->route('admin.dashboard');
        }
    }
    public function historyByID($id)
    {
        if (Auth::user()->role == "User") {
            if (Auth::check() == true) {
                $name = "history";
                $history = History::where('id', $id)->first();
                $results = $history->response;
                return view('frontend.variation', compact('results', 'name'));
            } else {
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('admin.dashboard');
        }
    }
    public function variation()
    {
        if (Auth::user()->role == "User") {
            if (Auth::check() == true) {
                $name = "social-media-ad-copy-creation";
                return view('frontend.variation', compact('name'));
            } else {
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('admin.dashboard');
        }
    }
    public function ShowLoginPage()
    {
        if (Auth::check() == true) {
            return redirect()->back();
        } else {
            return view('Auth.login');
        }
    }
    public function ShowSignupPage()
    {
        if (Auth::check() == true) {
            return redirect()->back();
        } else {
            return view('Auth.signup');
        }
    }
    public function ShowForgetPasswordPage()
    {
        if (Auth::check() == true) {
            return redirect()->back();
        } else {
            return view('Auth.forgetPassword');
        }
    }
    public function VerifyUser()
    {
        if (Auth::check() == true) {
            if (Auth::user()->code == true) {
                return view('Auth.VerifyUser');
            } else {
                return redirect()->back()->with('error', 'Account is already verified!');
            }
        } else {
            return redirect()->route('login');
        }
        }

        public function RegisterUser(Request $request)
        {
            try {
                // Validate user input
                $validatedData = $request->validate([
                    'name' => 'required|max:15',
                    'email' => 'required|email|unique:users|max:255',
                    'password' => 'required|string|confirmed|min:8',
                ], [
                    'name.required' => 'Name is required.',
                    'name.max' => 'Name must be less than 15 characters.',
                    'email.required' => 'Email is required.',
                    'email.email' => 'Email must be a valid email address.',
                    'email.max' => 'Email must be less than 255 characters.',
                    'email.unique' => 'Email is already registered.',
                    'password.required' => 'Password is required.',
                    'password.string' => 'Password must be a string.',
                    'password.confirmed' => 'Password confirmation does not match.',
                    'password.min' => 'Password must be at least 8 characters long.',
                ]);
        
                // Check if the email exists in allowed_users table
                // $allowedUser = AllowedUsers::where('email', $request->email)->first();
                // if (!$allowedUser) {
                //     throw ValidationException::withMessages(['email' => 'Email not allowed. Contact admin for more details.']);
                // }
        
                // Create user data
                $totalToken = ChatGpt::findOrFail(1);
                $data = [
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'password' => Hash::make($validatedData['password']),
                    'code' => str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT),
                    'role' => 'User',
                    'lastTokens' => 0,
                    'lastDate' => Carbon::now()->format('Y-m-d'),
                ];
        
                $user = User::create($data);
                if (!$user) {
                    throw new Exception('Failed to create user.');
                }
        
                Mail::send('emails.verifyemail', ['otp' => $data['code']], function ($message) use ($request) {
                    $message->to($request->email);
                    $message->subject('Verify Email');
                });
        
                return redirect()->route('login')->with('success', 'Account created successfully!');
            } catch (ValidationException $e) {
                return redirect()->route('signup')->withErrors($e->errors());
            } catch (Exception $e) {
                return redirect()->route('signup')->with('error', $e->getMessage());
            }
        }
        // public function RegisterUser(Request $request)
        // {
        //     $validatedData = $request->validate([
        //         'name' => 'required|max:15',
        //         'email' => 'required|email|unique:users|max:255',
        //         'password' => 'required|string|confirmed|min:8',
        //     ], [
        //         'name.required' => 'Name is required.',
        //         'name.max' => 'Name must be less than 15 characters.',
        //         'email.required' => 'Email is required.',
        //         'email.email' => 'Email must be a valid email address.',
        //         'email.max' => 'Email must be less than 255 characters.',
        //         'password.required' => 'Password is required.',
        //         'password.string' => 'Password must be a string.',
        //         'password.confirmed' => 'Password confirmation does not match.',
        //         'password.min' => 'Password must be at least 8 characters long.',
        //     ]);
        //     try {
        //         $allowedUsers = AllowedUsers::get();
        //         $emailFound = false;
        //         foreach ($allowedUsers as $key => $value) {
        //             if (strtolower($value->email) == strtolower($request->email)) {
        //                 $emailFound = true;
        //                 break;
        //             }
        //         }
        //         if ($emailFound) {
        //             $totalToken = ChatGpt::where('id', 1)->first();
        //             $data = $validatedData;
        //             $data['password'] = Hash::make($request->input('password'));
        //             $data['code'] = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        //             $data['role'] = 'User';
        //             $data['lastTokens'] = $totalToken->default_tokens;
        //             $data['lastDate'] = Carbon::now()->format('Y-m-d');
        //             $user = User::create($data);
        //             if ($user) {
        //                 Mail::send('emails.verifyemail', ['otp' => $user['code']], function ($message) use ($request) {
        //                     $message->to($request->email);
        //                     $message->subject('Verify Email');
        //                 });
        //                 return redirect()->route('login')->with('success', 'Account Created Successfully!');
        //             } else {
        //                 return redirect()->route('signup')->with('error', 'Something went wrong. Please try again later!');
        //             }
        //         } else {
    
        //             return redirect()->back()->with('error', 'Email not found in Google sheet. Contact admin for more details. Thank you!');
        //         }
        //     } catch (Exception $e) {
    
        //         return redirect()->route('signup')->with('error', $e->getMessage());
        //     }
        // }
    

        public function postEditAutomation($userId)
        {
            try {
                DB::beginTransaction();
                
                $user = User::find($userId);
                
                // Check if the user exists and is a student
                if ($user && $user->is_user_student=="true") {
                    if ($user->last_login < Carbon::today() || is_null($user->last_login)) {
                        $user->lastTokens = 5000;
                        $user->save();
                    }
                }
        
                DB::commit();
                return redirect()->back()->with('success', 'Tokens updated successfully!');
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
        
        

        public function authenticate(Request $request)
        {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:8',
            ]);
        
            try {
                // Check if the email exists in the allowed_users table
                // $allowedUser = AllowedUsers::where('email', $request->email)->first();
                // if (!$allowedUser) {
                //     return redirect()->back()->with('error', 'Email not allowed. Contact admin for more details.');
                // }
        
                $credentials = $request->only('email', 'password');
                if (Auth::attempt($credentials)) {
                    $this->postEditAutomation(Auth::user()->id);
                    User::where('id', Auth::user()->id)->update(['last_login' => Carbon::now()]);
                    
    
                    if (Auth::user()->code == true) {
                        return redirect()->route('VerifyUser');
                    } else {
                        $totalToken = ChatGpt::where('id', 1)->first();
                        $user = User::find(Auth::user()->id);
                        if ($user->lastDate != Carbon::today()->toDateString()) {
                            $user->lastTokens = $totalToken->default_tokens;
                            $user->lastDate = Carbon::today()->toDateString();
                            $user->save();
                        }
                        return redirect()->route('Home');
                    }
                } else {
                    return redirect()->back()->with('error', 'Invalid email or password.');
                }
            } catch (Exception $e) {
                return redirect()->route('signup')->with('error', $e->getMessage());
            }
        }

        // public function authenticate(Request $request)

        // {
    
        //     $request->validate([
    
        //         'email' => 'required',
    
        //         'password' => 'required|min:8',
    
        //     ]);
    
        //     try {
        //         if ($request->emaiil == "admin@admin.com") {
        //             $credentials = $request->only('email', 'password');
        //             return redirect()->route('Home');
        //         }
        //         $allowedUsers = AllowedUsers::get();
        //         $emailFound = false;
        //         foreach ($allowedUsers as $key => $value) {
        //             if (strtolower($value->email) == strtolower($value->email)) {
        //                 $emailFound = true;
        //                 break;
        //             }
        //         }
        //         if ($emailFound) {
    
        //             $credentials = $request->only('email', 'password');
                    
                    
    
        //             if (Auth::guard('web')->attempt($credentials)) {
                        
        //                 $this->postEditAutomation(Auth::user()->id);
        //                 User::where('id', Auth::user()->id)->update(['last_login' => Carbon::now()]);
    
        //                 if (Auth::user()->code == true) {
    
        //                     return redirect()->route('VerifyUser');
        //                 } else {
    
        //                     $totalToken = ChatGpt::where('id', 1)->first();
    
        //                     $user_tokens = User::find(Auth::user()->id);
    
        //                     if ($user_tokens->lastDate != Carbon::now()->format('Y-m-d')) {
    
        //                         $user_tokens->lastTokens = $totalToken->default_tokens;
    
        //                         $user_tokens->lastDate = Carbon::now()->format('Y-m-d');
    
        //                         $user_tokens->save();
        //                     }
                            
        //                     return redirect()->route('Home');
        //                 }
        //             } else {
    
        //                 return redirect()->back()->with('error', 'Email or Password is Invalid!');
        //             }
        //         } else {
    
        //             return redirect()->back()->with('error', 'Email not found in Google sheet. Contact admin for more details. Thank you!');
        //         }
        //     } catch (Exception $e) {
    
        //         return redirect()->route('signup')->with('error', $e->getMessage());
        //     }
        // }
    
    public function PostVerifyUser(Request $request)

    {

        try {

            $code = $request->digit1 . $request->digit2 . $request->digit3 . $request->digit4 . $request->digit5 . $request->digit6;

            if (Auth::user()->code == $code) {

                $user = User::find(Auth::user()->id);

                $user->code = NULL;

                $user->save();

                return redirect()->route('Home')->with('success', 'Email Verified Successfully!');
            } else {

                return redirect()->back()->with('error', 'Code is Invalid!');
            }
        } catch (Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function logout()

    {

        Auth::logout();

        Session::flush();

        return redirect()->route('login');
    }

    public function PostForgetPassword(Request $request)

    {

        $request->validate(

            [

                'robot' => 'required',

                'email' => 'required|email|max:255',

            ],

            [

                'robot.required' => 'Please confirm that you are not a robot.',



                'email.required' => 'Email is required.',

                'email.email' => 'Email must be a type of email.',

                'email.max' => 'Email must be less then 255 characters.',

            ]

        );

        try {

            $email = $request->email;

            $emailcheck = User::where('email', $email)->count();

            if ($emailcheck < 1) {

                return redirect()->back()->with('error', 'Email not found!');
            }

            $newPassword = Str::random(8);

            $user = User::where('email', $email)->first();

            $user->password = Hash::make($newPassword);

            $user->save();

            $mail = Mail::send('emails.forgetPassword', ['password' => $newPassword], function ($message) use ($request) {

                $message->to($request->email);

                $message->subject('Forget Password');
            });

            if ($mail == true) {

                return redirect()->route('login')->with('success', 'A new password has been sent to your email.');
            } else {

                return redirect()->back()->with('error', 'Something went wrong. Try again later.');
            }
        } catch (Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function ComposerCall()

    {

        Artisan::call('migrate');

        dd('success');
    }

    public function ComposerCallR()

    {

        Artisan::call('migrate:refresh --seed');

        dd('success');
    }

    public function ResendCode(Request $request)

    {

        try {

            $user = User::where('email', Auth::user()->email)->first();

            $user->code = 123456;

            $user->save();

            if ($user == true) {

                Mail::send('emails.verifyemail', ['otp' => $user['code']], function ($message) use ($request) {

                    $message->to(Auth::user()->email);

                    $message->subject('Verify Email');
                });

                return redirect()->route('VerifyUser')->with('success', 'New Code has been sent Successfully. Check Spam Folder for code if you dont see it in Inbox.');
            } else {

                return redirect()->back()->with('error', 'Something went wrong. Try again later!');
            }
        } catch (Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function CreatePost($name)

    {

        return view('frontend.index', compact('name'));
    }
}
