<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\AdminTasks;
use App\AssignTasks;
use Illuminate\Http\Request;
use Carbon\Carbon;


class AssignTasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $assign_tasks = AssignTasks::orderBy('id','DESC')
        ->where('assign_tasks.guide_id',Auth::user()->id)
        ->join('users as users_u','users_u.id','assign_tasks.user_id')
        ->join('users as users_g','users_g.id','assign_tasks.guide_id')
        ->join('users as users_r','users_r.id','assign_tasks.reviewer_id')
        ->select('assign_tasks.*','users_u.name','users_g.name as gname','users_r.name as rname')
        ->paginate(15);

        
        return view('AssignTasks.index',compact('assign_tasks'))
            ->with('i', ($request->input('page', 1) - 1) * 15);
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
        $ids[] = $request->user_id;
        $request->user_id=$ids[0];
        for($i=0;$i<count($ids[0]);$i++)    
        {
            try 
            {
                $record = [
                    'task_id' => $request->task_id,
                    'assigned_by_userid' => $request->assign_user_id,
                    'user_id' =>$ids[0][$i],
                    'guide_id' => $request->guide_id,
                    'reviewer_id' => $request->reviewer_id,
                    'target_at' => $request->target_at,

                ];    
                AssignTasks::create( $record );
                // return $record;
                
            }
            catch (Exception $e)
            {
                render($e);

                return false;
            }
        

                   
                    
        }

        return redirect()->route('AssignTasks.index')
            ->with('success','Task Assigned Successfully');
    
}

    /**
     * Display the specified resource.
     *
     * @param  \App\AssignTasks  $assignTasks
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$bid)
    {
        $wid = $request->wid;

        if(Auth::user()->id == 1){
            $users = DB::table('users')
            ->where('users.branch_id',$bid)
            ->select('users.*')
            ->get();
     
        $teachers = DB::table('users')     
                ->where('users.role_id','<=',5) 
                ->select('users.*')
                ->get();
        }
        else{
            $users = DB::table('users')
            ->where('users.institutes_id',Auth::User()->institutes_id)
            ->where('users.branch_id',$bid)
            ->select('users.*')
            ->get();
     
            $teachers = DB::table('users')
                ->where('users.institutes_id',Auth::User()->institutes_id)        
                ->where('users.role_id','<=',5) 
                ->select('users.*')
                ->get();

        }

        $branches = DB::table('branches')
            ->select('branches.*')->get();

    $works = AdminTasks::find($wid);
    $targetdate=Carbon::now('Asia/Kolkata')->addDays(5);
    return view('AssignTasks.create',compact('users','works','teachers','targetdate','branches',$wid));
    // return compact('wid','bname');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AssignTasks  $assignTasks
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->institutes_id == 1){
            $users = DB::table('users')
            ->where('users.role_id','>',5)
            ->select('users.*')
            ->get();
     
        $teachers = DB::table('users')     
                ->where('users.role_id','<=',5) 
                ->select('users.*')
                ->get();
        }
        else{
            $users = DB::table('users')
            ->where('users.institutes_id',Auth::User()->institutes_id)
            ->where('users.role_id','>',5)
            ->select('users.*')
            ->get();
     
            $teachers = DB::table('users')
                ->where('users.institutes_id',Auth::User()->institutes_id)        
                ->where('users.role_id','<=',5) 
                ->select('users.*')
                ->get();

        }

        $branches = DB::table('branches')
            ->select('branches.*')->get();
        $batches = DB::table('batches')
            ->select('batches'); 
    
        $works = AdminTasks::find($id);
        $targetdate=Carbon::now('Asia/Kolkata')->addDays(5);
        return view('AssignTasks.create',compact('users','works','teachers','targetdate','branches',$id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AssignTasks  $assignTasks
     * @return \Illuminate\Http\Response
     */
    public function update($id)
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AssignTasks::find($id)->delete();
        return redirect()->route('AssignTasks.index')
                        ->with('success','AssignTasks deleted successfully');
    }

    public function render($request, Exception $exception)
{
    if ($exception instanceof CustomException) {
        return response()->view('errors.custom', [], 500);
    }

    return parent::render($request, $exception);
}
}
