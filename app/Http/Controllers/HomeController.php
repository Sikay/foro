<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
        $user = User::select('email')->where('email', '=', 'admin@gmail.com');
        $user = null;
        if (empty($user)) {
            dd('holi');
        }
        dd($user);
        return view('home');
    }
}
