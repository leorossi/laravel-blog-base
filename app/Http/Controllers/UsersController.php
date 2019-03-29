<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userscontroller extends controller
{
    public function index()
    {
        $users = user::all();
        return view('users.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $roles = role::orderby('name')->get();
        return view('users.create', [
            'roles' => $roles
        ]);
    }

    public function store(request $request)
    {
        $user = new user();
        $user->email = $request->input('email');
        $user->name = $request->input('email');
        $user->password = hash::make($request->input('password'));
        $user->role()->associate($request->input('role_id'));
        $user->save();
        
        return redirect(route('users.index'));
    }

    public function show($id)
    {
    
    }

    public function edit($id)
    {
        $user = user::findorfail($id);
        $roles = role::orderby('name')->get();
        return view('users.edit', [ 'user' => $user, 'roles' => $roles ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->input('passsword')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role()->associate($request->input('role_id'));
        $user->save();
        return redirect(route('users.index'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect(route('users.index'));
    }
}
