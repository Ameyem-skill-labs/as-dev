<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Image;

use DB;
use Auth;
use Charts;
use App\Chart;
use App\User;
use App\UserTasks;
use App\AdminTasks;
use App\AssignTasks;
use App\Role;
use App\Institutes;
use App\Http\Controllers\DateTime;



class DashboardController extends Controller
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
          
            
        if(Auth::user()->role_id >= 6)
        {
           
            //Student Total Assigned Tasks of all Users
           
          $assign_tasks = DB::table('assign_tasks')
          ->where('assign_tasks.user_id',Auth::user()->id)
          ->orderBy('assign_tasks.updated_at')->get();

          $assign_chart = Charts::database($assign_tasks, 'line', 'highcharts')
          ->title('Assigned Tasks')
          ->elementLabel("Tasks")
          ->dimensions(0, 300)
          ->responsive(false)
          ->lastByMonth(10, true);

            // Student Total Completed Tasks of all Users

          $completedtasks = DB::table('assign_tasks')
          ->where('assign_tasks.user_id',Auth::user()->id)
          ->where('assign_tasks.status','approved')
          ->orderBy('assign_tasks.updated_at')->get();
          
          $completed_chart = Charts::database($completedtasks, 'line', 'highcharts')
          ->title('Completed Tasks')
          ->elementLabel("Tasks")
          ->dimensions(0, 300)
          ->responsive(false)
          ->lastByMonth(10, true);


        // Student Pregress Line graph all tasks

          $progress = DB::table('assign_tasks')
          ->where('assign_tasks.user_id',Auth::user()->id)
          ->where('assign_tasks.status','approved')
          ->orderBy('assign_tasks.updated_at','desc')->select('assign_tasks.updated_at','assign_tasks.user_credits')->get()->toArray();

          if (empty($progress)) 
          {
           $progress_chart =  Charts::create('line', 'highcharts')
           ->title('Example Progress Chart')
           ->elementLabel('date')
           ->labels(['First', 'Second', 'Third'])
           ->values([5,10,20])
           ->dimensions(0,300)
           ->responsive(false);
          }
          else{

          
          $datearray = array_column($progress,'updated_at');
          for($i=0;$i<count($datearray);$i++)
          {
              $date = new \DateTime($datearray[$i]);
              $dt[$i] = $date->format('d M y'); 
          }
         

          $marksarray = array_column($progress,'user_credits');

          $count_array[0] = $marksarray[0];
          for($i=1;$i<count($marksarray);$i++)
          {
              $count_array[$i] = $count_array[$i-1] + $marksarray[$i];
          }
         
          $progress_chart = Charts::create('line', 'highcharts')
          ->title('Progress Chart')
          ->elementLabel('Date')
          ->labels(array_reverse($dt))
          ->values($count_array)
          ->dimensions(0,300)
          ->responsive(false);
      } 

            //Student total droped tasks
            $droptasks = DB::table('assign_tasks')
            ->where('assign_tasks.user_id',Auth::user()->id)
            ->where('assign_tasks.status','drop')
            ->orderBy('assign_tasks.updated_at','desc')->get();


            $total_user_tasks = $assign_tasks->count();
            $totalcredits = $completedtasks->sum('user_credits');
            $completedtasks = $completedtasks->count();
            $droptasks = $droptasks->count();

            $fdate = Auth::user()->created_at;
            $tdate = date('Y-m-d H:s:i');
            $datetime1 = new \DateTime($fdate);
            $datetime2 = new \DateTime($tdate);
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a');//Its counts all days

            $role = DB::table('roles')->where('roles.id',Auth::User()->role_id)->select('roles.name')->get();
            $institute_name = DB::table('institutes')->where('institutes.id',Auth::User()->institutes_id)->select('institutes.name')->get();
        }
        else
        {      
           
           //Total Assigned Tasks of all Users assigned by teacher
           $assign_tasks = AssignTasks::orderBy('id','DESC')
        //    ->where('assign_tasks.assigned_by_userid',Auth::user()->id)
           ->where('assign_tasks.guide_id',Auth::user()->id)
        //    ->orWhere('assign_tasks.reviewer_id',Auth::user()->id)
           ->get();

           $assign_chart = Charts::database($assign_tasks, 'line', 'highcharts')
           ->title('Assigned Tasks')
           ->elementLabel("Tasks")
           ->dimensions(0, 300)
           ->responsive(false)
           ->lastByMonth(12, true);
           
           
           // Total Completed Tasks of all Users assigned by teacher
           $completedtasks = DB::table('assign_tasks')
           ->where('assign_tasks.status','approved')
        //    ->where('assign_tasks.assigned_by_userid',Auth::user()->id)
           ->where('assign_tasks.guide_id',Auth::user()->id)
        //    ->orWhere('assign_tasks.reviewer_id',Auth::user()->id)
           ->orderBy('assign_tasks.updated_at','desc')->get();

           $completed_chart = Charts::database($completedtasks, 'line', 'highcharts')
           ->title('Completed Tasks')
           ->elementLabel("Tasks")
           ->dimensions(0, 300)
           ->responsive(false)
           ->lastByMonth(12, true);



           // Pregress Line graph all Registerd user Count

           $progress = DB::table('assign_tasks') 
        //    ->where('assign_tasks.assigned_by_userid',Auth::user()->id)
           ->where('assign_tasks.guide_id',Auth::user()->id)
        //    ->orWhere('assign_tasks.reviewer_id',Auth::user()->id)
           ->where('assign_tasks.status','approved')
           ->orderBy('assign_tasks.updated_at','desc')->select('assign_tasks.updated_at','assign_tasks.guide_credits')->get()->toArray();

           if (empty($progress)) 
           {
            $progress_chart =  Charts::create('line', 'highcharts')
            ->title('Example Progress Chart')
            ->elementLabel('date')
            ->labels(['First', 'Second', 'Third'])
            ->values([5,10,20])
            ->dimensions(0,300)
            ->responsive(false);
           }
           else{


           $datearray = array_column($progress,'updated_at');
           for($i=0;$i<count($datearray);$i++)
           {
               $date = new \DateTime($datearray[$i]);
               $dt[$i] = $date->format('d M y'); 
           }


           $marksarray = array_column($progress,'guide_credits');

           $count_array[0] = $marksarray[0];
           for($i=1;$i<count($marksarray);$i++)
           {
               $count_array[$i] = $count_array[$i-1] + $marksarray[$i];
           }
          
           $progress_chart = Charts::create('line', 'highcharts')
           ->title('Progress Chart')
           ->elementLabel('Date')
           ->labels(array_reverse($dt))
           ->values($count_array)
           ->dimensions(0,300)
           ->responsive(false);
       } 

           //Total droped tasks of Students 

           $droptasks = DB::table('assign_tasks')
           ->where('assign_tasks.status','drop')
           ->where('assign_tasks.guide_id',Auth::user()->id)
           ->orderBy('assign_tasks.created_at','desc')->get();


           $admin_tasks = AdminTasks::orderBy('id','DESC')
                           ->where('admin_tasks.user_id',Auth::user()->id);                           
           $totaltasks = $admin_tasks->count();

           $user_tasks = DB::table('assign_tasks')
                       ->where('assign_tasks.user_id',Auth::user()->id)
                       ->orderBy('assign_tasks.updated_at')->get();
           $total_user_tasks =  $user_tasks->count();

           $totalassigntasks = $assign_tasks->count();

           $users = User::orderBy('id','asc')
                   ->where('users.institutes_id',Auth::user()->institutes_id);
           $totalusers = $users->count();

           $allusers = User::count();

           // Total comments of Teacher assigned tasks
           $totalcomments = DB::table('user_tasks')
           ->join('assign_tasks','user_tasks.assigntask_id','assign_tasks.id')
           ->join('users','assign_tasks.assigned_by_userid','users.id')
        //    ->where('assign_tasks.assigned_by_userid',Auth::User()->id)
           ->where('assign_tasks.guide_id',Auth::User()->id)
        //    ->orWhere('assign_tasks.reviewer_id',Auth::User()->id)
           ->count();

           $totalcredits = $completedtasks->sum('guide_credits');
           $completedtasks = $completedtasks->count();
           $droptasks = $droptasks->count();

           $fdate = Auth::user()->created_at;
           $tdate = date('Y-m-d H:s:i');
           $datetime1 = new \DateTime($fdate);
           $datetime2 = new \DateTime($tdate);
           $interval = $datetime1->diff($datetime2);
           $days = $interval->format('%a');//now do whatever you like with $days

           $role = DB::table('roles')->where('roles.id',Auth::User()->role_id)->select('roles.name')->get();
           $institute_name = DB::table('institutes')->where('institutes.id',Auth::User()->institutes_id)->select('institutes.name')->get();


             
        }
        
        return view('dashboard', ['assign_chart' => $assign_chart,'completed_chart' => $completed_chart,'progress_chart' => $progress_chart])
        ->with(compact('total_user_tasks','totaltasks','totalassigntasks','totalusers','allusers','totalcomments','totalcredits','days','completedtasks','droptasks','institute_name','role'));

    }


}
