<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class UserController extends Controller {

    public function login() {
        
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $email = request('email');
            $user = Auth::user();
            $this->content['token'] = $user->createToken($email)->accessToken;
            $this->content['success'] = true;
            $status = 200;
        } else {
            $this->content['error'] = "Unauthorised";
            $this->content['success'] = false;
            $status = 401;
        }

        return response()->json($this->content, $status);
    }

    public function details() {
        return response()->json(['user' => Auth::user()]);
    }

}
