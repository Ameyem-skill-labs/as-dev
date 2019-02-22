@extends('layouts.app')
@section('content')

<style>
        #quiz_maker{
                background: white;
        }
        .qbox{
                padding:2px;
                /* margin:5px; */
                color:black;
                font-weight:bold;
                box-shadow: 1px 1px 1px rgba(90, 90, 94, 0.3);
        }
       
        .correct-bg{
                background: #5bc20b;
                color:white;
        }
        .current-bg{
                background: #347AB6;
                color:white;
        }

</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ url('/home') }}">Back</a>
            </div>
        </div>
    </div>
</div>


<!-- <div class="container">  -->
    <!-- <div class="panel panel-primary"> -->
                <div>
                    <h4><u><b>Instructions to Attempt Quiz</b></u></h4>
                </div>
                <!-- <div class="panel-body"> -->
                <h4>1.One question display at a time.Each question has one minute time.Once Answer saved can't change.</h4>
                <h4>2.<span class="qbox correct-bg">1</span>Answerd question, <span class="qbox current-bg">1</span>Current Questions,<span class="qbox">1</span>Questions not Attempted.</h4>
                <h4>3.If all questions attempted Final submit will display.</h4>
            

                <!-- </div> -->
       
    <!-- </div> -->
<!-- </div> -->

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
            <div class="panel panel-primary">
                <div style="color:white" class="panel-heading">
                    <center>List Of Available Quizzes in this Portal</center>
                </div>
          

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr style="color:#660033">
                                <th>Quiz ID</th>
                                <th>Subject Name</th>
                                <th>Quiz Name</th>
                                <th>Total Questions</th>
                                <th>Options</th>
                            
                                
                            </tr>
                            @foreach ($quizzes as $key => $quiz)
                            <tr style="color:#2471A3">
                                <td>{{ $quiz->id }}</td>
                                <td>{{ $quiz->subject_name }}</td>
                                <td>{{ $quiz->quiz_name }}</td>
                                <td>
                                    <?php $questions = DB::table('online_quiz_questions')
                                    ->where('online_quiz_questions.online_quiz_id',$quiz->id)->count();
                                    ?>
                                    {{ $questions }}
                                </td>
                                <td>
                                <?php 
                                $quiz_status = DB::table('online_quiz_statuses')
                                ->join('online_quiz_questions','online_quiz_statuses.online_quiz_question_id','=','online_quiz_questions.id')
                                ->where('online_quiz_questions.online_quiz_id',$quiz->id)
                                ->where('online_quiz_statuses.user_id', Auth::user()->id)
                                ->select('online_quiz_statuses.*')->count();
                                $questions = DB::table('online_quiz_questions')
                                ->where('online_quiz_questions.online_quiz_id',$quiz->id)->count();

                                ?>
                                @if($quiz_status >= 1)
                                <a class="btn btn-success btn-xs" href="{{ route('viewResult',he($quiz->id)) }}">View Result</a>
                                @elseif($quiz->publish_status == 1)
                                <a class="btn btn-primary btn-xs" href="{{ route('quizAttempt',he($quiz->id)) }}">Attempt</a>
                                @else
                                <a class="btn btn-primary btn-xs">Quiz Not Ready</a>
                                @endif
                        
                                </td>
                            
                                
                                
                            </tr>
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection




