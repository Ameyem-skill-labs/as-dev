<?php

namespace App\Http\Controllers;
use App\UserTasks;
use App\AdminTasks;
use App\AssignTasks;
use App\coursetask;
use DB;
use Auth;
use App\User;
use App\Http\Kernel;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\TaskMigrate;
use Illuminate\Http\Request;
use App\Http\Controllers\View;
use Carbon\Carbon;

//to be deleted
use App\quiz;
use App\constants;
use App\course;
use App\chapter;
use App\coinsinout;
use App\questions;
use App\enrollment;
use App\quizstatuses;
use App\chapterstatuses;


class TaskMigrateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
            $assign_tasks = AssignTasks::orderBy('id','DESC')
            ->join('admin_tasks','assign_tasks.task_id', '=', 'admin_tasks.id')
            ->where('assign_tasks.status','=','review')
            ->where('assign_tasks.guide_id',Auth::user()->id)

            // ->where(function ($query) {
            //     $query->where('assign_tasks.assigned_by_userid',Auth::user()->id)
            //           ->orWhere('assign_tasks.guide_id',Auth::user()->id);
            //         //   ->orWhere('assign_tasks.reviewer_id',Auth::user()->id);
            // })

            ->join('users as users_u','users_u.id','assign_tasks.user_id')
            ->join('users as users_s','users_s.id','assign_tasks.assigned_by_userid')
            ->join('users as users_g','users_g.id','assign_tasks.guide_id')
            ->join('users as users_r','users_r.id','assign_tasks.reviewer_id')

            ->select('assign_tasks.*','admin_tasks.worktitle','admin_tasks.workdescription','admin_tasks.whatinitforme','admin_tasks.usercredits','admin_tasks.uploads','users_u.first_name as first_name','users_u.last_name as last_name','users_s.name as sname','users_g.name as gname','users_r.name as rname')
            ->orderBy('assign_tasks.task_id','desc')->get();  

            $review = $assign_tasks->count();
            $redo = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','redo')->where('assign_tasks.reviewer_id',Auth::user()->id)->count();
            $review_for_approve = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','review_for_approve')->where('assign_tasks.reviewer_id',Auth::user()->id)->count();
            $drop = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','drop')->where('assign_tasks.reviewer_id',Auth::user()->id)->count();
            $approved = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','approved')->where('assign_tasks.guide_id',Auth::user()->id)->count();
            // return $approved;

        
       
        return view('TaskMigrate.index',compact('assign_tasks','review','redo','review_for_approve','drop','approved'));
            
        
    
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
        $reserved_credits=0;
        $this->validate($request, [
            'assigntask_id' => 'required',
            'request_for' => 'required',
            'request_by' => 'required',
            'rating_to_user' => 'nullable',
            'rating_to_guide' => 'nullable',
            'message' => 'required',
            'uploads' => 'file | mimes:rar,zip,jpg,jpeg,png,pdf,ppt,pptx,xls,xlsx,doc,docx,bmp |max:5120',
            'created_at' => '',

        ]);

        $task = new UserTasks;
        $task->assigntask_id = $request->assigntask_id;
        $task->request_for = $request->request_for;
        $task->request_by = $request->request_by;
        $task->rating_to_user = $request->rating_to_user;
        $task->rating_to_guide = $request->rating_to_guide;
        $task->message = $request->message;
        if($request->hasFile('uploads')) {
            $task->uploads = storeFile($request->uploads,'uploads');
            }
        $task->created_at = $request->created_at;

        // return $task;
        

        if($task->request_for =='approved'){
            $reserved_credits=DB::table('assign_tasks')->where('assign_tasks.id', $task->assigntask_id) 
            ->join('admin_tasks','assign_tasks.task_id','admin_tasks.id')
            ->select('admin_tasks.usercredits')->get()->pluck('usercredits')[0];

            $reserved_guide_credits=DB::table('assign_tasks')->where('assign_tasks.id', $task->assigntask_id) 
            ->join('admin_tasks','assign_tasks.task_id','admin_tasks.id')
            ->select('admin_tasks.guidecredits')->get()->pluck('guidecredits')[0];

            $reserved_reviewer_credits=DB::table('assign_tasks')->where('assign_tasks.id', $task->assigntask_id) 
            ->join('admin_tasks','assign_tasks.task_id','admin_tasks.id')
            ->select('admin_tasks.reviewercredits')->get()->pluck('reviewercredits')[0];

            DB::table('assign_tasks')->where('id', $task->assigntask_id)  
            ->update(['user_credits' => $task->rating_to_user * $reserved_credits/10,'guide_credits' => $task->rating_to_guide * $reserved_guide_credits/10,
            'reviewer_credits' => 10*$reserved_guide_credits/10,
            'status' => $task->request_for,'completed_at' => Carbon::now('Asia/Kolkata')]); 


             // This updates course score after quiz submission
        // return
            $task_details=AssignTasks::where('assign_tasks.id', $task->assigntask_id)   
            ->join('chapters','chapters.id','assign_tasks.course_chapter_id')
            ->select('chapters.course_id','assign_tasks.user_id')
            ->first();

            $course_id=$task_details->course_id;

            $student_id=$task_details->user_id;
            $status=1;
        self::UpdateScore($course_id,Auth::user()->id,1); //1 is status of the course. it needs to be 1
        }

        DB::table('assign_tasks')->where('id', $task->assigntask_id)  
        ->update(['status' => $task->request_for,'completed_at' => Carbon::now('Asia/Kolkata')]);

    
        
        unset($task->rating_to_user);//removed as there is no column of obtained marks 
        unset($task->rating_to_guide);

        $task->save();

       
 
    return redirect()->route('TaskMigrate.index');
                   
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\TaskMigrate  $taskMigrate
     * @return \Illuminate\Http\Response
     */
    public function show($cop_str)
    {   
            if($cop_str == 'review_for_approve')
            {
                $assign_tasks = AssignTasks::orderBy('id','DESC')
                ->join('admin_tasks','assign_tasks.task_id', '=', 'admin_tasks.id')
                ->where('assign_tasks.status',$cop_str)
                ->where('assign_tasks.reviewer_id',Auth::user()->id)

                ->join('users as users_u','users_u.id','assign_tasks.user_id')
                ->join('users as users_s','users_s.id','assign_tasks.assigned_by_userid')
                ->join('users as users_g','users_g.id','assign_tasks.guide_id')
                ->join('users as users_r','users_r.id','assign_tasks.reviewer_id')

                ->select('assign_tasks.*','admin_tasks.worktitle','admin_tasks.workdescription','admin_tasks.whatinitforme','admin_tasks.usercredits','admin_tasks.uploads','users_u.first_name as first_name','users_u.last_name as last_name','users_s.name as sname','users_g.name as gname','users_r.name as rname')
                ->get();

                $review = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','review')->where('assign_tasks.guide_id',Auth::user()->id)->count();
                $redo = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','redo')->where('assign_tasks.guide_id',Auth::user()->id)->count();
                $review_for_approve = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','review_for_approve')->where('assign_tasks.reviewer_id',Auth::user()->id)->count();
                $drop = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','drop')->where('assign_tasks.guide_id',Auth::user()->id)->count();
                $approved = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','approved')->where('assign_tasks.guide_id',Auth::user()->id)->count();
                

            }
            else{

                $assign_tasks = AssignTasks::orderBy('id','DESC')
                ->join('admin_tasks','assign_tasks.task_id', '=', 'admin_tasks.id')
                ->where('assign_tasks.status',$cop_str)
                ->where('assign_tasks.guide_id',Auth::user()->id)

                ->join('users as users_u','users_u.id','assign_tasks.user_id')
                ->join('users as users_s','users_s.id','assign_tasks.assigned_by_userid')
                ->join('users as users_g','users_g.id','assign_tasks.guide_id')
                ->join('users as users_r','users_r.id','assign_tasks.reviewer_id')
 
                ->select('assign_tasks.*','admin_tasks.worktitle','admin_tasks.workdescription','admin_tasks.whatinitforme','admin_tasks.usercredits','admin_tasks.uploads','users_u.first_name as first_name','users_u.last_name as last_name','users_s.name as sname','users_g.name as gname','users_r.name as rname')
                ->get();

                $review = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','review')->where('assign_tasks.guide_id',Auth::user()->id)->count();
                $redo = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','redo')->where('assign_tasks.guide_id',Auth::user()->id)->count();
                $review_for_approve = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','review_for_approve')->where('assign_tasks.reviewer_id',Auth::user()->id)->count();
                $drop = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','drop')->where('assign_tasks.guide_id',Auth::user()->id)->count();
                $approved = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','approved')->where('assign_tasks.guide_id',Auth::user()->id)->count();


            }
            // else if($cop_str == 'drop'|| 'approved'){

            //     $assign_tasks = AssignTasks::orderBy('id','DESC')
            //     ->join('admin_tasks','assign_tasks.task_id', '=', 'admin_tasks.id')
            //     ->where('assign_tasks.status',$cop_str)
            //     ->where('assign_tasks.guide_id',Auth::user()->id)
            //         // ->where('assign_tasks.assigned_by_userid',Auth::user()->id)
            //         //       ->orWhere('assign_tasks.guide_id',Auth::user()->id)
            //         //       ->orWhere('assign_tasks.reviewer_id',Auth::user()->id);
                

            //     ->join('users as users_u','users_u.id','assign_tasks.user_id')
            //     ->join('users as users_s','users_s.id','assign_tasks.assigned_by_userid')
            //     ->join('users as users_g','users_g.id','assign_tasks.guide_id')
            //     ->join('users as users_r','users_r.id','assign_tasks.reviewer_id')

            //     ->select('assign_tasks.*','admin_tasks.worktitle','admin_tasks.workdescription','admin_tasks.whatinitforme','admin_tasks.usercredits','admin_tasks.uploads','users_u.name','users_s.name as sname','users_g.name as gname','users_r.name as rname')
            //     ->get();

            //     $review = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','review')->where('assign_tasks.guide_id',Auth::user()->id)->count();
            //     $redo = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','redo')->where('assign_tasks.guide_id',Auth::user()->id)->count();
            //     $review_for_approve = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','review_for_approve')->where('assign_tasks.reviewer_id',Auth::user()->id)->count();
            //     $drop = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','drop')->where('assign_tasks.guide_id',Auth::user()->id)->count();
            //     $approved = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','approved')->where('assign_tasks.guide_id',Auth::user()->id)->count();

            // }
            
                       
        return view('TaskMigrate.index',compact('assign_tasks','review','redo','review_for_approve','drop','approved'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TaskMigrate  $taskMigrate
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $task_id = $request->task_id;

        $task_details = AdminTasks::find($task_id);
        $user_tasks = UserTasks::orderBy('id','ASC')
        
        ->join('assign_tasks','user_tasks.assigntask_id', '=', 'assign_tasks.id')

        ->join('users as users_u','users_u.id','user_tasks.request_by')

        ->where( 'assign_tasks.id',$id)
        ->select('user_tasks.*','users_u.first_name','users_u.profilepic')->get();
        $assign_tasks = AssignTasks::find($id);
        

            return view('TaskMigrate.edit',compact('user_tasks','assign_tasks','task_details',$id));      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaskMigrate  $taskMigrate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskMigrate $taskMigrate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TaskMigrate  $taskMigrate
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskMigrate $taskMigrate)
    {
        //
    }
















    public function UpdateScore($course_id,$student_id,$status){
       
        

        $course=course::where('courses.id',$course_id)
        ->where('enrollments.student_id',$student_id)
        ->join('enrollments','enrollments.course_id','courses.id')
        // ->join('users as users_g','users_g.id','enrollments.guide_id')
        // ->join('users as users_r','users_r.id','enrollments.reviewer_id')
        ->select('courses.*','enrollments.student_id','enrollments.guide_id','enrollments.reviewer_id')
        ->first();
    
    $chids=chapter::where('course_id',$course_id)
                ->select('id')->get()->toArray();
                // return constants::marks_for_currect_answer;
            $ch_statuses=chapterstatuses::
            // where()
            whereIn('chapter_id',$chids)->where('user_id',$student_id)
                ->select('*')->get();
                // var_dump($chids);
                // echo(')))))*****************************');
    // return [$chids,$course_id, $chids,$ch_statuses, constants::max_credits_each_chapter*count($chids),
    // $ch_statuses->sum('quiz_score')*constants::marks_for_currect_answer];
    // return
    $nquestions_true=quiz::whereIn('chapter_id',$chids)
        ->where('quizstatuses.user_id',$student_id )
        ->join('questions','questions.quiz_id','=','quizzes.id')
        ->join('quizstatuses','quizstatuses.question_id','questions.id')
        // ->select(DB::raw('select sum(result = 1) as yes, sum(my_bool = 0) as no'));
        ->where('quizstatuses.result','true')->count();
        
    $course_credits=$ch_statuses->sum('task_credits')+
        constants::max_credits_each_chapter*count($chids)+
        $nquestions_true*constants::marks_for_currect_answer;
    if($status==2){
        $hours4completion = (new Carbon($ch_statuses->first()->created_at))
            ->diffInHours(new Carbon($ch_statuses->last()->created_at));
                $days=$hours4completion/24.0;
                if($days<1) $days=1;
    $bonus_credits= $course_credits*constants::perc_cred_bonus_on_coursecompletion/$days;
    }else{
        $bonus_credits=null;
    }
    
            
    // return [$course_credits,$bonus_credits];
    
    enrollment::where('course_id',$course_id)
    ->where('student_id',$student_id )
    ->update(['status'=>$status,'course_credits'=>$course_credits,'bonus_credits'=>$bonus_credits]);

    
            return $course;



        }
       
    
    













}
