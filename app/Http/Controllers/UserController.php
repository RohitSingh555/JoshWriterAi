<?php

namespace App\Http\Controllers;

use App\Models\ChatGpt;
use App\Models\History;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
    public function historyById($id)
    {
        $history = History::where('id', $id)->first();
        $results = $history->response;
        return view('admin.User.historiesById', compact('results'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $count = User::where('email', $request->email)->count();
            if ($count == 1) {
                return redirect()->back()->with('error', 'User is already exsits!');
            }
            $totalToken = ChatGpt::where('id', 1)->first();
            $data = $request->all();
            $data['password'] = Hash::make($request->password);
            $data['lastTokens'] = $totalToken->default_tokens;
            $data['lastDate'] = Carbon::now()->format('Y-m-d');
            User::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'User created successfully!');
        } catch (Exception $e) {
            DB::rollback();
            DB::commit();
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
}
