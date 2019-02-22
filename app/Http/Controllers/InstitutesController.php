<?php

namespace App\Http\Controllers;

use App\institute;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\AdminTasks;
use App\AssignTasks;
use Carbon\Carbon;

class InstitutesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('institutes.index');
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
            'name' => 'required',
            'city' => 'required',
            'address' => 'required',
        ]);

        institute::create($request->all());

        return redirect('/home')
                ->with('success','Institute added Successfully');
                        
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\institutes  $institutes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
                
        $users = DB::table('users')
            ->where('users.institutes_id',Auth::User()->institutes_id)
            ->where('users.role_id','=',5)
            ->select('users.*')
            ->get();
     
        $teachers = DB::table('users')
                ->where('users.institutes_id',Auth::User()->institutes_id)        
                ->where('users.role_id','<=',5) 
                ->select('users.*')
                ->get();

        $branches = DB::table('branches')
            ->select('branches.*')->get();
    
        $works = AdminTasks::find($id);
        $targetdate=Carbon::now('Asia/Kolkata')->addDays(5);
        return view('AssignTasks.create',compact('users','works','teachers','targetdate','branches',$id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\institutes  $institutes
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\institutes  $institutes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'wid' => 'required',
            'batch_id' => 'required',
            'bid' => 'required',
        ]);

        $users = DB::table('users')
        ->where('users.institutes_id',Auth::User()->institutes_id)
        ->where('users.branch_id',$bid)
        ->where('users.batch_id',$batch_id)
        ->select('users.*')
        ->get();
 
        $teachers = DB::table('users')
            ->where('users.institutes_id',Auth::User()->institutes_id)        
            ->where('users.role_id','<=',5) 
            ->select('users.*')
            ->get();

        $branches = DB::table('branches')
            ->select('branches.*')->get();
        $batches = DB::table('batches')
            ->select('batches');

    $works = AdminTasks::find($wid);
    $targetdate=Carbon::now('Asia/Kolkata')->addDays(5);
    return view('AssignTasks.create',compact('users','works','teachers','targetdate','branches','batches',$wid));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\institutes  $institutes
     * @return \Illuminate\Http\Response
     */
    public function destroy(institutes $institutes)
    {
        //
    }
}
