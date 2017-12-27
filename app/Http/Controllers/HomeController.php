<?php

namespace App\Http\Controllers;

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
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Autoryzacja użytkowników
        $request->user()->authorizeRoles(['employee', 'manager']);
        return view('home');
    }
}
