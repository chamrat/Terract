<?php

namespace App\Http\Controllers;

use Auth;

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
        $user = Auth::user();
        $userType = $user->roles()->get()[0]->name;
        if ($userType=='Landlord'){
        return view('home');
        }
        elseif ($userType=='Tenant'){
        return view('tenant');

        }
    }


}
