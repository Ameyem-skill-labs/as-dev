<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


// namespace App\Http\Controllers\student;
use DB;
use App\quiz;
use App\User;
use App\constants;
use App\course;
use App\chapter;
use App\coinsinout;
use App\questions;
use App\enrollment;
use App\coursetask;
use App\AssignTasks;
use App\quizstatuses;
use App\chapterstatuses;
use App\online_quiz_statuses;
use App\online_quiz_questions;
use App\online_quiz_results;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class MyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature ='my:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        // SELECT * FROM `online_quiz_statuses` WHERE `created_at`<'2019-02-21 15:41:58' and `created_at`>'2019-02-21 12:41:58'
        // echo 'Hello world';
        // $quiz_id=6;
        // $all_questions = DB::table('online_quiz_questions')
        // ->join('online_quizzes','online_quiz_questions.online_quiz_id','=','online_quizzes.id')
        // ->where('online_quiz_questions.online_quiz_id',$quiz_id)
        // ->select('online_quiz_questions.id')->get()->toarray();

        // foreach($all_questions as $q){
        //     // var_dump($q->id);
        //     echo (string)$q->id.' 
        // ' ;
        //     // echo "<br>";
        // }

        // $score = null;
        // $total = null;
        // // return
        
        // // return $quiz_id;
        $quiz_id = 6;
        $questions = online_quiz_questions::where('online_quiz_id',$quiz_id)->get(['id'])->toarray();

        
        

        // // return var_dump($questions);
        // //return 'Answers will be opened soon.....';
        // $total_questions = count($questions);
        // /*
        //     Evaluate each question attended
        //     Check whether the answer is correct
        // */
        // return
        $users=user::join('institutes','institutes.id','users.institutes_id')
        ->get(['users.id','users.first_name','users.last_name','users.email','users.phone_number','institutes.name'])->toarray();
        // $userid=Auth::user()->id;
        $mystr='';
        // foreach ($users as $useride){
        //     $mystr=$mystr.$useride['first_name'].'
        //     ';
        //     echo (string)$i.', '.$useride['id'].', '.$useride['first_name'].' '.$useride['last_name'].',   '.$useride['email'].',   '
        //             .$useride['phone_number'].',      '.$useride['name'].',    '.$score.'   '.$res_score->score;
        // }
        // echo $mystr;
        // return;

        // $mystr='Calculated for ids... ';

        
        $i=0;
        foreach ($users as $useride){
            $userid=$useride['id'];
            $result_not_exists = DB::table('online_quiz_results')->where('user_id',$userid)->where('quiz_id',$quiz_id)->doesntExist();
            $res_score=DB::table('online_quiz_results')->where('user_id',$userid)->where('quiz_id',$quiz_id)->first(['score']);
            // var_dump($res_score->score);
            // return;
            //     // return $enquiry;
        //     //store all quiz results in online_quiz_results table.
            // if($result_not_exists){
            $quiz_result = online_quiz_statuses::wherein('online_quiz_question_id',$questions)
            ->where('user_id',$userid)
            ->where('created_at','<','2019-02-22 16:41:58')
            ->where('created_at','>','2019-02-21 12:41:58')
            ->get(['user_id','result']);
                $total_questions=$quiz_result ->count();
            
                if($total_questions>0 ){
                    $i++;
                    $score= $quiz_result->where('result','true')->count();
                    echo (string)$i.', '.$useride['id'].', '.$useride['first_name'].' '.$useride['last_name'].',   '.$useride['email'].',   '
                    .$useride['phone_number'].',      '.$useride['name'].',    '.$score.'   '.'
                ';

                    // if(($score/$total_questions)*100 >= constants::min_score_for_pass ){ $status ='passed'; } else{$status = 'failed';}

                    // $results = [
                    //     'total' => $total_questions, 
                    //     'score' =>$score,
                    //     'status'=>$status
                    // ];

                    // // $mystr= $mystr.', '.(string)($userid); 
                    // $quiz_results = new online_quiz_results();
                    // $quiz_results->user_id = $userid;
                    // $quiz_results->quiz_id = $quiz_id;
                    // $quiz_results->score = $score;
                    // $quiz_results->total = $total_questions;
                    // try{
                    //     $quiz_results->save(); 
                    // }
                    // catch(Exception $e) {
                    //     echo 'Message: ' .$e->getMessage();
                    //   }
                    
                // }
                
                    if(($score/$total_questions)*100 >= constants::min_score_for_pass ){ $status ='passed'; } else{$status = 'failed';}

                    $results = [
                        'total' => $total_questions, 
                        'score' =>$score,
                        'status'=>$status
                    ];

                    // $mystr= $mystr.', '.(string)($userid); 
                    $quiz_results = new online_quiz_results();
                    $quiz_results->user_id = $userid;
                    $quiz_results->quiz_id = $quiz_id;
                    $quiz_results->score = $score;
                    $quiz_results->total = $total_questions;
                    if($result_not_exists){
                        $quiz_results->save(); 
                    }

                    
                }
            }
        // }
            
        // return $mystr;

    }
}
