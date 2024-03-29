<?php

namespace App\Http\Controllers;

use App\Models\AllowedUsers;
use App\Models\ChatGpt;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AllowedUsersController extends Controller
{
    public function get()
    {
        if (Auth::user()->role == 'Admin') {
            $User = AllowedUsers::orderBy('id', 'desc')->get();
            return view('admin.allowed.index', compact('User'));
        } else {
            $User = AllowedUsers::orderBy('id', 'desc')->where('id', '!=', auth()->id())->where('email', '!=', "admin@admin.com")->where('role', '!=', "Manager")->get();
            return view('admin.allowed.index', compact('User'));
        }
    }




    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $count = AllowedUsers::where('email', $request->email)->count();
            if ($count == 1) {
                return redirect()->back()->with('error', 'Email is already exsits!');
            }
            $data = $request->all();
            AllowedUsers::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Email added successfully!');
        } catch (Exception $e) {
            DB::rollback();
            DB::commit();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $Users = AllowedUsers::where('id', $id)->first();
        return view('admin.allowed.edit', compact('Users', 'id'));
    }
    public function postEdit(Request $request)
    {
        $id = $request->id;
        $User = AllowedUsers::where('id', $id)->first();
        try {
            DB::beginTransaction();
            if ($User) {
                $User->update($request->all());
            }
            DB::commit();
            return redirect()->route('Users.get')->with('success', 'Email updated successfully!');
        } catch (Exception $e) {
            DB::rollback();
            DB::commit();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function updateToken(Request $request, $id)
    {
        if (Auth::user()->role == 'Admin') {
            $User = AllowedUsers::where('id', $id)->first();
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
                AllowedUsers::where('id', $id)->delete();
                DB::commit();
                return redirect()->back()->with('success', 'Email deleted successfully!');
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
