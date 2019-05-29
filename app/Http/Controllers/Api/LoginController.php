<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends BaseApiController
{
      public function login(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->input('email'))
            ->first();
        if ($user) {
            if (Hash::check($request->input('password'), $user->password)) {
                return $this->success($user->toArray());
            }
        }
        return $this->error('Invalid credentials', [], 400);
    }
}
