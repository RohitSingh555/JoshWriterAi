<?php



namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use App\Models\ChatGpt;

use App\Models\History;

use App\Models\User;

use Carbon\Carbon;

use Exception;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserWelcome;
use Illuminate\Support\Str;
use App\Mail\PasswordChanged;


class UserController extends Controller

{

    public function get()

    {

        if (Auth::user()->role == 'Admin') {

            $User = User::orderBy('id', 'desc')->where('id', '!=', auth()->id())->get();

            return view('admin.User.index', compact('User'));
        } else {

            $User = User::orderBy('id', 'desc')->where('id', '!=', auth()->id())->where('email', '!=', "admin@admin.com")->where('role', '!=', "Manager")->get();

            return view('admin.User.index', compact('User'));
        }
    }



    public function histories($id)

    {

        $history = History::where('user_id', $id)->orderBy('id', 'desc')->get();

        return view('admin.User.histories', compact('history'));
    }

    public function All_histories()
    {
        $histories = History::with('user')->orderBy('id', 'desc')->get();
        $userEmails = $histories->pluck('user.email')->unique();
        return view('admin.User.allHistories', compact('histories', 'userEmails'));
    }



    public function historyById($id)

    {

        $history = History::where('id', $id)->first();

        $results = $history->response;

        return view('admin.User.historiesById', compact('results'));
    }


    public function toggleStudent(Request $request)
    {
        try {
            $userId = $request->input('userId');
            $isChecked = $request->input('isChecked');

            $user = User::find($userId);

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not found'], 404);
            }

            $user->is_user_student = $isChecked;
            $user->save();

            return response()->json(['success' => true, 'message' => 'Student status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function AutomatedUserCreator(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                '*.email' => 'required|email',
            ]);

            $users = [];
            foreach ($request->all() as $data) {
                $email = $data['email'];

                $user = User::where('email', $email)->first();

                if (!$user) {
                    if ($request->isMethod('post')) {
                        $request->validate([
                            '*.name' => 'required|string',
                            '*.is_user_student' => 'required|string',
                        ]);

                        $name = $data['name'];
                        $isUserStudent = $data['is_user_student'];
                        $password = Str::random(8);
                        $totalToken = ChatGpt::where('id', 1)->first();

                        $user = User::firstOrCreate(
                            ['email' => $email],
                            [
                                'name' => $name,
                                'password' => Hash::make($password),
                                'lastTokens' => $totalToken->default_tokens,
                                'lastDate' => Carbon::now()->format('Y-m-d'),
                                'is_user_student' => $isUserStudent,
                                'role' => 'User',
                            ]
                        );

                        Mail::to($email)->send(new NewUserWelcome($password));
                    }
                } else {
                    if ($request->isMethod('put') || $request->isMethod('patch')) {
                        $fillableFields = array_intersect_key($data, array_flip([
                            'name', 'used_tokens', 'last_login', 'role', 'password_status',
                            'is_user_student', 'status'
                        ]));

                        $user->update($fillableFields);
                    }
                }

                $users[] = $user;
            }

            DB::commit();

            return response()->json(['success' => 'Users handled successfully!', 'users' => $users], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $count = User::where('email', $request->email)->count();

            if ($count == 1) {
                return redirect()->back()->with('error', 'User already exists!');
            }

            // Retrieve password from request data before hashing
            $password = $request->password;

            $totalToken = ChatGpt::where('id', 1)->first();

            $data = $request->all();
            $data['password'] = Hash::make($request->password);
            $data['lastTokens'] = $totalToken->default_tokens;
            $data['lastDate'] = Carbon::now()->format('Y-m-d');

            $user = User::create($data);

            // Send welcome email to the newly created user
            Mail::to($user->email)->send(new NewUserWelcome($password));

            DB::commit();

            return redirect()->back()->with('success', 'User created successfully!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function edit($id)

    {

        $Users = User::where('id', $id)->first();

        return view('admin.User.edit', compact('Users', 'id'));
    }

    public function postEdit(Request $request)

    {

        $id = $request->id;

        $User = User::where('id', $id)->first();

        try {

            DB::beginTransaction();

            if ($User) {

                $User->update($request->all());
            }

            DB::commit();

            return redirect()->route('Users.get')->with('success', 'User updated successfully!');
        } catch (Exception $e) {

            DB::rollback();

            DB::commit();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateToken(Request $request, $id)

    {

        if (Auth::user()->role == 'Admin') {

            $User = User::where('id', $id)->first();

            try {

                DB::beginTransaction();

                if ($User) {

                    $User->update(['lastTokens' => $request->lastTokens]);
                }

                DB::commit();

                return redirect()->back()->with('success', 'Record updated successfully!');
            } catch (Exception $e) {

                DB::rollback();

                DB::commit();

                return redirect()->back()->with('error', $e->getMessage());
            }
        } else {

            return redirect()->back()->with('error', 'You are not authorize to make these changes. Thank you!');
        }
    }

    public function destroy($id)

    {

        if (Auth::user()->role == 'Admin') {

            try {

                DB::beginTransaction();

                User::where('id', $id)->delete();

                DB::commit();

                return redirect()->back()->with('success', 'User deleted successfully!');
            } catch (Exception $e) {

                DB::rollback();

                DB::commit();

                return redirect()->back()->with('error', $e->getMessage());
            }
        } else {

            return redirect()->back()->with('error', 'You are not authorize to make these changes. Thank you!');
        }
    }

    public function changePassword(Request $request)
    {
        try {
            // Validate form data
            $request->validate([
                'email' => 'required',
                'oldPassword' => 'required',
                'newPassword' => 'required|min:8',
                'repeatNewPassword' => 'required|same:newPassword',
            ]);

            $email = $request->email;
            $user = User::where('email', $email)->first();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Email not found!'], 404);
            }

            if (!Hash::check($request->oldPassword, $user->password)) {
                return response()->json(['success' => false, 'message' => 'Incorrect old password'], 422);
            }

            $user->password = Hash::make($request->newPassword);
            $user->password_status = "Changed password";
            $user->save();

            Auth::logout();
            Mail::to($user->email)->send(new PasswordChanged());
            return response()->json(['success' => true, 'message' => 'Password changed successfully']);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
