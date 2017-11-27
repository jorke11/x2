<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');


class UserController extends Controller {

    public function login(Request $req) {
        $in = $req->all();
        
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

    public function getUser() {
        $data = User::find(Auth::user()->id);
        return response()->json($data);
    }
    public function getUsers() {
        $data = User::all();
        return response()->json($data);
    }

}
