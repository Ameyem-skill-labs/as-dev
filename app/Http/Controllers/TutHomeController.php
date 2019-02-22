<?php

namespace App\Http\Controllers;
// use App\Http\helpers;
use Illuminate\Http\Request;

class TutHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
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
        return view('tuthome');
        // return "working";
    }

    public  function blocked(){
        return view('general.blocked');
    }
}
