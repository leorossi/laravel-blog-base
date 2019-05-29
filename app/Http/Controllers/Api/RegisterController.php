<?php

namespace App\Http\Controllers\Api;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RegisterController extends BaseApiController
{
    
    public function register(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'role' => [
                'required',
                Rule::in(['editor', 'reader'])
            ]
        ]);
        
        $role = Role::where('name', $request->input('role'))->first();
        if ($role) {
            $user = new User($request->all());
            $user->password = Hash::make($request->input('password'));
            $user->api_token = Str::random(60);
            $user->role()->associate($role);
            $user->save();
            return $this->success($user->toArray());
        }
        
        return $this->error('Invalid role');
    }
}
