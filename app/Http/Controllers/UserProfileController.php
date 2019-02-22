<?php

namespace App\Http\Controllers;

use App\UserProfile;
use Illuminate\Http\Request;
use DB;
use Auth;
use Image;
use Charts;
use Storage;
use App\Role;
use App\User;
use App\Chart;
use App\UserTasks;
use App\AdminTasks;
use App\AssignTasks;
use App\Institutes;
use App\Http\Requests;
use App\Http\Controllers\DateTime;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->institutes_id == 1)
        {

            $userss = User::orderBy('id','asc')->get();

            foreach($userss as $user)
            {
                $completedtasks = DB::table('assign_tasks')
                                    ->where('assign_tasks.user_id',$user->id)
                                    ->where('assign_tasks.status','approved')
                                    ->orderBy('assign_tasks.updated_at')->get();
                $user->totalcredits = $completedtasks->sum('user_credits');
            }
                $users = $userss->sortByDesc('totalcredits');

            return view('UserProfile.index',compact('users'));

        }

        else
        {
            $userss = User::orderBy('id','asc')
                ->where('users.institutes_id',Auth::user()->institutes_id)->get();

            foreach($userss as $user)
            {
                $completedtasks = DB::table('assign_tasks')
                                    ->where('assign_tasks.user_id',$user->id)
                                    ->where('assign_tasks.status','approved')
                                    ->orderBy('assign_tasks.updated_at')->get();
                $user->totalcredits = $completedtasks->sum('user_credits');
            }
                $users = $userss->sortByDesc('totalcredits');

        return view('UserProfile.index',compact('users'));
            // ->with('i', ($request->input('page', 1) - 1) * 50);

        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('UserProfile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Auth::user()->id;
        // $user_id = hd($request->user_id);
        // return $user_id;
        $this->validate($request, [
            'user_id' => 'required',
            'profilepic' => 'image | mimes:jpeg,bmp,png,jpg| max:1024',
           
        ]);
        
        $profile = new UserProfile();
        $profile->user_id = $request->user_id;
        $profile->profilepic = storeFile($request->profilepic,'profilepic');

        DB::table('users')->where('id', $profile['user_id'])
        ->update(['profilepic' => $profile['profilepic']]);

        if(isset(Auth::user()->profilepic)){   
            Storage::disk('profilepic')->delete(Auth::user()->profilepic);
        } 

        $encripted_user_id = he($profile->user_id);
        return redirect()->route('UserProfile.show',compact('encripted_user_id'))
                        ->with('success','Profile created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $id = hd($id);
        $users = User::find($id);

        //Student Total Assigned Tasks of all Users
           
        $assign_tasks = DB::table('assign_tasks')
        ->where('assign_tasks.user_id',$id)
        ->orderBy('assign_tasks.updated_at')->get();

        $assign_chart = Charts::database($assign_tasks, 'line', 'highcharts')
        ->title('Assigned Tasks')
        ->elementLabel("Tasks")
        ->dimensions(0, 300)
        ->responsive(false)
        ->lastByMonth(10, true);

// Student Total Completed Tasks of all Users

        $completedtasks = DB::table('assign_tasks')
        ->where('assign_tasks.user_id',$id)
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
        ->where('assign_tasks.user_id',$id)
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

        else
        {

        
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
                    ->where('assign_tasks.user_id',$id)
                    ->where('assign_tasks.status','drop')
                    ->orderBy('assign_tasks.updated_at','desc')->get();

                    $created_at = DB::table('users')->where('users.id',$id)
                    ->select('users.created_at')->get();
                    $totaltasks = $assign_tasks->count();
                    $totalcredits = $completedtasks->sum('user_credits');
                    $completedtasks = $completedtasks->count();
                    $droptasks = $droptasks->count();


                    $fdate =  User::find($id)->created_at;
                    $tdate = date('Y-m-d H:s:i');
                    $datetime1 = new \DateTime($fdate);
                    $datetime2 = new \DateTime($tdate);
                    $interval = $datetime1->diff($datetime2);
                    $days = $interval->format('%a');//Its counts all days

                    $role = DB::table('roles')->where('roles.id',$users->role_id)->select('roles.name')->get();
                    $institute_name = DB::table('institutes')->where('institutes.id',$users->institutes_id)->select('institutes.name')->get();


                    return view('UserProfile.show', ['assign_chart' => $assign_chart,'completed_chart' => $completed_chart,'progress_chart' => $progress_chart])->with(compact('users','totaltasks','totalcredits','days','completedtasks','droptasks','created_at','role','institute_name'));
                            // return view('Profile.show',compact('users'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id1 = hd($id);
        $users = User::find($id1);
        return view('UserProfile.edit',compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id1 = hd($id);
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
        ]);


        User::find($id1)->update($request->all());
        return redirect()->route('UserProfile.show',compact('id'))
                        ->with('success','Profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('UserProfile.index')
                        ->with('success','Profile deleted successfully');
    }
}
