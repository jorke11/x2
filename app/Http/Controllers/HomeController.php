<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    
    public function qr()
    {
        echo QrCode::format("png")->size(100)->generate('http://www.simplesoftware.io',public_path()."/codigo.png");
        
        exit;
        
//        echo "asdsa";exit;
        
    }
}
