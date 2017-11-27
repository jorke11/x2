<?php

namespace App\Http\Controllers\Security;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Security\Roles;

class UsersController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        $role = Roles::all();
        return view("Security.users.init", compact("role"));
    }

}
