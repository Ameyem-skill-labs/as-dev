<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use App\UserTasks;
use App\AdminTasks;
use App\AssignTasks;
use DB;
use Auth;
use App\User;
use App\Http\Kernel;
use App\coursetask;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\TaskMigrate;
use Illuminate\Http\Request;
use App\Http\Controllers\View;

class UserTasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assign_tasks = AssignTasks::orderBy('id','DESC')
        ->join('admin_tasks','assign_tasks.task_id', '=', 'admin_tasks.id')

        ->join('users as users_u','users_u.id','assign_tasks.user_id')
        ->join('users as users_s','users_s.id','assign_tasks.assigned_by_userid')
        ->join('users as users_g','users_g.id','assign_tasks.guide_id')
        ->join('users as users_r','users_r.id','assign_tasks.reviewer_id')

        ->where('assign_tasks.user_id',Auth::user()->id)
        ->where(function ($query) {
            $query->whereNull('assign_tasks.status')
                  ->orWhere('assign_tasks.status','NA')
                  ->orWhere('assign_tasks.status','initiated');
        })
        ->select('assign_tasks.*','admin_tasks.worktitle','admin_tasks.workdescription','admin_tasks.whatinitforme','admin_tasks.usercredits','admin_tasks.uploads','users_u.first_name as first_name','users_u.last_name as last_name','users_s.name as sname','users_g.name as gname','users_r.name as rname')
        ->get();
        
        $start = $assign_tasks->count();
        $review = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','review')->where('assign_tasks.user_id',Auth::user()->id)->count();
        $redo = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','redo')->where('assign_tasks.user_id',Auth::user()->id)->count();
        $drop = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','drop')->where('assign_tasks.user_id',Auth::user()->id)->count();
        $approved = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','approved')->where('assign_tasks.user_id',Auth::user()->id)->count();

        return view('UserTasks.index',compact('assign_tasks','start','review','redo','drop','approved'));
        
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
            'assigntask_id' => 'required',
            'request_for' => 'required',
            'request_by' => 'required',
            'message' => 'required',
            'uploads' => 'file | mimes:rar,zip,jpg,jpeg,png,pdf,ppt,pptx,xls,xlsx,doc,docx,bmp |max:5120',
            'created_at' => '',

        ]);

        $task = new UserTasks;
        $task->assigntask_id = $request->assigntask_id;
        $task->request_for = $request->request_for;
        $task->request_by = $request->request_by;
        $task->message = $request->message;
        if($request->hasFile('uploads')) {
        $task->uploads = storeFile($request->uploads,'uploads');
        }
        $task->created_at = $request->created_at;

        // return $task;

        DB::table('assign_tasks')->where('id', $task->assigntask_id)
        ->update(['status' => $task->request_for]);
 
       $task->save();
        if(isset($request->course_id)){
            return redirect()->route('viewCourse',['id'=>$request->course_id]);
        }
      
        // return $requestData;
        return redirect()->route('UserTasks.index'); 
                        
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\institutes  $institutes
     * @return \Illuminate\Http\Response
     */
    public function show($cop_str)
    {
        $assign_tasks = AssignTasks::orderBy('id','DESC')
            ->join('admin_tasks','assign_tasks.task_id', '=', 'admin_tasks.id')

            ->join('users as users_u','users_u.id','assign_tasks.user_id')
            ->join('users as users_s','users_s.id','assign_tasks.assigned_by_userid')
            ->join('users as users_g','users_g.id','assign_tasks.guide_id')
            ->join('users as users_r','users_r.id','assign_tasks.reviewer_id')

            ->where('assign_tasks.status',$cop_str)
            ->where('assign_tasks.user_id',Auth::user()->id)
            ->select('assign_tasks.*','admin_tasks.worktitle','admin_tasks.workdescription','admin_tasks.whatinitforme','admin_tasks.usercredits','admin_tasks.uploads','users_u.first_name as first_name','users_u.last_name as last_name','users_s.name as sname','users_g.name as gname','users_r.name as rname')
            ->get();

            $start      = AssignTasks::orderBy('id','DESC')->where(function ($query) {
                $query->whereNull('assign_tasks.status')
                      ->orWhere('assign_tasks.status','NA')
                      ->orWhere('assign_tasks.status','initiated');
            })->where('assign_tasks.user_id',Auth::user()->id)->count();
            $review     = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','review')->where('assign_tasks.user_id',Auth::user()->id)->count();
            $redo       = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','redo')->where('assign_tasks.user_id',Auth::user()->id)->count();
            $drop       = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','drop')->where('assign_tasks.user_id',Auth::user()->id)->count();
            $approved   = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','approved')->where('assign_tasks.user_id',Auth::user()->id)->count();
             
        
        return view('UserTasks.index',compact('assign_tasks','start','review','redo','drop','approved'));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     *
     * @param  \App\institutes  $institutes
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$assign_task_id)
    {   
        // return
        $user_tasks = UserTasks::orderBy('id','ASC')
        ->join('assign_tasks','user_tasks.assigntask_id', '=', 'assign_tasks.id')

        ->join('users as users_u','users_u.id','user_tasks.request_by')

        ->where( 'assign_tasks.id',$assign_task_id)
        ->select('user_tasks.*','users_u.first_name','users_u.profilepic')->get();
        // return $user_tasks;
        $assign_tasks = AssignTasks::find($assign_task_id);

        $task_details = AdminTasks::find($assign_tasks->task_id);
        if(isset($request->course_id)){
            return view('UserTasks.edit',compact('user_tasks','assign_tasks','task_details'))->with(['course_id'=>$request->course_id]);
        }
        return view('UserTasks.edit',compact('user_tasks','assign_tasks','task_details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\institutes  $institutes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
