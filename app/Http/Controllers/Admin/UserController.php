<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\User;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view("admin.user.index", compact('users'));
    }

    public function create()
    {
        return view("admin.user.create");
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8',],
            'role' => ['required']
        ]);
        try {
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'role' => $request['role']
            ]);

            return redirect('/admin/users')->with("success", "User created successfully.");
        } catch (Exception $ex) {
            return redirect()->back()->with("error", "Something went wrong while creating new user.");
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with("error", "User not found.");
        }
        return view("admin.user.edit", compact("user"));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with("error", "User not found.");
        }

        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8',],
            'role' => ['required']
        ]);
        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->update();

            return redirect('/admin/users')->with("success", "User created successfully.");
        } catch (Exception $ex) {
            return redirect()->back()->with("error", "Something went wrong while creating new user.");
        }
    }

    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with("error", "User not found.");
        }

        $user->delete();
        return redirect('/admin/users')->with("success", "User deleted successfully.");
    }
}
