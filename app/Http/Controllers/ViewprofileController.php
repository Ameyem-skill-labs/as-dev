<?php

namespace App\Http\Controllers;

use App\viewprofile;
use App\profile;
use App\User;
use Auth;
use DB;
use App\Http\Controllers\Lava;
use App\Http\Controllers\View;
use App\Http\Controllers\ChartManager;
// use Khill\Lavacharts\Support\JavascriptDate as Date;
use Illuminate\Http\Request;


class ViewprofileController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index(Request $request)
    {  
        
        $users = User::find(Auth::user()->id);
        return view('viewprofile.index',compact('users'));
              
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => '',
            'last_name' => '',
            'phone_number' => '',
            'dob' => '',
            'qualification' => '',
            'specialization' => '',
            'marks' => '',
            'passout' => '',
            'collegeaddress' => '',
            'homeaddress' => '',
        ]);


        User::create($request->all());
        return redirect()->route('viewprofile.index')
                        ->with('success','Profile created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\viewprofile  $viewprofile
     * @return \Illuminate\Http\Response
     */
    public function show(viewprofile $viewprofile)
    {
        $users = User::find($id);
        return view('viewprofile.show',compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\viewprofile  $viewprofile
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id1 = hd($id);
        $users = User::find($id1);
        return view('viewprofile.edit',compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\viewprofile  $viewprofile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = hd($id);
        $this->validate($request, [
            'first_name' => '',
            'last_name' => '',
            'roll_number' => '',
            'phone_number' => '',
            'dob' => '',
            'qualification' => '',
            'specialization' => '',
            'marks' => '',
            'passout' => '',
            'collegeaddress' => '',
            'homeaddress' => '',
            'profilepic' => '',
        ]);

        User::find($id)->update($request->all());
        return redirect()->route('viewprofile.index')
                        ->with('success','Profile updated successfully');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\viewprofile  $viewprofile
     * @return \Illuminate\Http\Response
     */
    public function destroy(viewprofile $viewprofile)
    {
        //
    }
}


