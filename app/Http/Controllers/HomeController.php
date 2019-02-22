<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Image;

use DB;
use Auth;

use App\constants;
use App\course;
use App\AssignTasks;
use App\User;
use App\coinsinout;
use App\enrollment;
use App\chapter;
use App\chapterstatuses;
use App\coursetask;
use App\Role;
use App\Institutes;
use App\Http\Controllers\DateTime;



class HomeController extends Controller
{

    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       $coins = coinsinout::where('user_id',
        Auth::user()->id)->sum('coins');
        if(!$coins){
            // DB::table('coinsinouts')->insert(['user_id'=>
            // Auth::user()->id,'nature_id'=>1,'coins'=>100]); 
            $coins =100;

            $coinsinout = new  coinsinout();
            $coinsinout->user_id = Auth::user()->id;
            $coinsinout->nature_id = 1;
            $coinsinout->coins = $coins;
            // return $coinsinout;
            $coinsinout->save();
        }
       
    if(isMentor()){
            // return  
        $mentor_courses = Auth::user()->course()->get();
        /*render course list page*/
        // return $courses;
        $users = User::all();
        foreach($mentor_courses as $course){
            $course->enroll =  enrollment::where('course_id',$course->id)->select('course_id','student_id')->count();
            $course->student_list = enrollment::orderBy('id','DESC')
            ->join('users','enrollments.student_id','users.id')
            ->where('enrollments.course_id',$course->id) 
            ->join('users as users_s','users_s.id','enrollments.student_id')   
            ->select('enrollments.*','users_s.first_name as sname')->pluck('sname');       
        }        
        // return $courses;


        $courses = course::all();
            // return
            $studentData = Auth::user()->load('enrollment.course');
            // return $studentData->enrollment;
            foreach($studentData->enrollment as $course ){
                $chapters=chapter::where('course_id',$course->course_id)
                ->select('id')->get();
            $coursestatuses=
            chapterstatuses::whereIn('chapter_id',$chapters->toArray())->where('user_id',Auth::user()->id)
            ->select('*')->get();
            $course->ch_completed=$coursestatuses->sum('status');
            $course->ch_outof=count($chapters);
            $course->creds_earned=$coursestatuses->sum('task_credits')
            +$coursestatuses->sum('quiz_score')*constants::max_credits_each_chapter/100;
            // $course->creds_outof=40;
            // $course->bonus_creds=20;
            }
            // return $studentData;
            $enrollments = enrollment::where('student_id',Auth::user()->id)->get();
            $ongoingtasks = AssignTasks::where('user_id',Auth::user()->id)
            ->where('status', '!=' , 'approved')
            ->join('chapters','course_chapter_id','chapters.id')
            ->select('assign_tasks.id','assign_tasks.status','course_chapter_id','chapters.course_id')->get();
            // $constants=new constants;
            // return constants::perc_cred_bonus_on_coursecompletion;
            $ongoingtasks = AssignTasks::orderBy('id','DESC')
            ->where('assign_tasks.user_id',Auth::user()->id)
            ->where('assign_tasks.status', '!=' , 'approved')
            ->join('coursetasks','assign_tasks.task_id','coursetasks.task_id')
            ->join('chapters','coursetasks.chapter_id','chapters.id')
            ->join('courses','chapters.course_id','courses.id')
            ->join('courses as cname','cname.id','courses.id')
            ->join('chapters as cpname','cpname.id','chapters.id')
            ->select('assign_tasks.*','chapters.course_id','coursetasks.chapter_id','cname.name as course_name','cpname.name as chapter_name')->get();

            foreach($courses as $course){
                $chapters_ids = chapter::where('course_id',$course->id)->select('id')->get();
                // foreach($chapters_ids as $chapters_id){
                   $chapter_tasks= coursetask::whereIn('chapter_id',$chapters_ids)
                   ->join('admin_tasks','admin_tasks.id','coursetasks.task_id')
                   ->select('usercredits')->get();
                   $course->no_tasks=count($chapter_tasks);
                //    return
                   $course->max_credits=$chapter_tasks->sum('usercredits')+count($chapters_ids)*constants::max_credits_each_chapter;
                   $course->bonus_credits=
                   $course->max_credits*constants::perc_cred_bonus_on_coursecompletion/constants::ndays_assumed_4course_completion;
                // } 
                foreach( $users as $user){
                    if($course->user_id==$user->id){
                        $course->f_name=$user->first_name;
                        $course->l_name=$user->last_name;
                    }
                }
                foreach($enrollments as $enrollment){
                    if($course->id==$enrollment->course_id){
                        $course->enrolled=true;
                        }
                    }
                }
                    
             

            return view('home')->with('mentor_courses', $mentor_courses)->with('coins',$coins)->with('studentData',$studentData)->with('ongoingtasks',$ongoingtasks)->with('courses', $courses);

        }
        elseif(isAdmin()){
            $users = User::orderBy('id','DESC')
            ->join('institutes','users.institutes_id','institutes.id')
            ->join('roles','users.role_id','roles.id')
            ->join('institutes as users_i','users_i.id','institutes.id')
            ->join('roles as users_r','users_r.id','roles.id')
            ->select('users.*','users_i.name as iname','users_r.name as rname')->get();
            // return $users;
            return view('home')->with('coins',$coins)->with('users',$users);
        }

        elseif(isStudent()){
            $courses = course::all();

            $studentData = Auth::user()->load('enrollment.course');
            // return $studentData->enrollment;
            foreach($studentData->enrollment as $course ){
                $chapters=chapter::where('course_id',$course->course_id)
                ->select('id')->get();
            $coursestatuses=
            chapterstatuses::whereIn('chapter_id',$chapters->toArray())->where('user_id',Auth::user()->id)
            ->select('*')->get();
            $course->ch_completed=$coursestatuses->sum('status');
            $course->ch_outof=count($chapters);
            $course->creds_earned=$coursestatuses->sum('task_credits')
            +$coursestatuses->sum('quiz_score')*constants::max_credits_each_chapter/100;

            }

            $enrollments = enrollment::where('student_id',Auth::user()->id)->get();
            $ongoingtasks = AssignTasks::orderBy('id','DESC')
            ->where('assign_tasks.user_id',Auth::user()->id)
            ->where('assign_tasks.status', '!=' , 'approved')
            ->join('coursetasks','assign_tasks.task_id','coursetasks.task_id')
            ->join('chapters','coursetasks.chapter_id','chapters.id')
            ->join('courses','chapters.course_id','courses.id')
            ->join('courses as cname','cname.id','courses.id')
            ->join('chapters as cpname','cpname.id','chapters.id')
            ->select('assign_tasks.*','chapters.course_id','coursetasks.chapter_id','cname.name as course_name','cpname.name as chapter_name')->get();

            foreach($courses as $course){
                $chapters_ids = chapter::where('course_id',$course->id)->select('id')->get();
                // foreach($chapters_ids as $chapters_id){
                   $chapter_tasks= coursetask::whereIn('chapter_id',$chapters_ids)
                   ->join('admin_tasks','admin_tasks.id','coursetasks.task_id')
                   ->pluck('usercredits');
                   $course->no_tasks=count($chapter_tasks);
                   $course->f_name=User::where('id',$course->user_id)->pluck('first_name')[0];

                   $course->max_credits=$chapter_tasks->sum('usercredits')+count($chapters_ids)*constants::max_credits_each_chapter;
                   $course->bonus_credits=
                   $course->max_credits*constants::perc_cred_bonus_on_coursecompletion/constants::ndays_assumed_4course_completion;

                foreach($enrollments as $enrollment){
                    if($course->id==$enrollment->course_id){
                        $course->enrolled=true;
                        }
                    
                }
            }
        return view('home')->with('studentData',$studentData)
        ->with('coins',$coins)->with('ongoingtasks',$ongoingtasks)
        ->with('courses', $courses);

        }
       

        
    }


}
