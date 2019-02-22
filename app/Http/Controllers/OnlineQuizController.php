<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Storage;
use App\User;
use App\quiz_online;
use App\subject;
use App\AdminTasks;
use App\AssignTasks;
use App\work_nature;
use App\online_quizzes;

class OnlineQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $quizs =  DB::table('online_quizzes')
        ->where('online_quizzes.user_id',Auth::user()->id)
        ->select('online_quizzes.*')->get();
        // return $quizs;
        return view('online_quiz.index',compact('quizs'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('online_quiz.create');
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
            'subject_name' =>'required',
            'quiz_name' => 'required',
            'user_id' => 'required',

        ]);
        // online_quiz::create($request->all());
        $quiz = new online_quizzes;
        $quiz->subject_name = $request->subject_name;
        $quiz->quiz_name = $request->quiz_name;
        $quiz->user_id = $request->user_id;
        $quiz->publish_status = 0;
        $quiz->save();

        return redirect()->route('online_quiz.index')
                        ->with('success','Quiz created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $quizzes =  DB::table('online_quizzes')
        ->select('online_quizzes.*')->get();
        // return $quizs;
        return view('online_quiz.show',compact('quizzes'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
