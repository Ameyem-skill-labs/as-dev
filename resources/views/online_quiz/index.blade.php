@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
            <!-- <div class="pull-left">
                <h4 style="color:green">Add New Subject
                <p>
                    <a href="{{ route('Subject.index') }}" class="btn btn-success btn-xs">Add</a>
                </p>
                </h4>          
            </div> -->
            <div class="pull-right">
                <a class="btn btn-success" href="{{ url('/home') }}">Back</a>
                <a class="btn btn-success" href="{{ route('online_quiz.create') }}"> Create New Quiz</a>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
        <div class="panel panel-primary">
                <div style="color:white" class="panel-heading">
                    <center>List Of Your Quizzes </center>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr style="color:#660033">
                                <th>Subject ID</th>
                                <th>Subject Name</th>
                                <th>Quiz Name</th>
                                <th>Options</th>
                                <th>Publish</th>
                            
                                
                            </tr>
                            @foreach ($quizs as $key => $quiz)
                            <tr style="color:#2471A3">
                                <td>{{ $quiz->id }}</td>
                                <td>{{ $quiz->subject_name }}</td>
                                <td>{{ $quiz->quiz_name }}</td>
                                <td>
                                    <a class="btn btn-primary btn-xs" href="{{ route('quizEdit',[$quiz->id]) }}">Manage Quiz</a>
                                </td>
                                <td>
                                    @if($quiz->publish_status==0)
                                        <td>
                                                <span class="label label-warning"> New
                                                &nbsp;
                                                <a  class="btn btn-primary"
                                                    href="{{ route('publishQuiz',['id'=>he($quiz->id)]) }}"> Publish</a>
                                                </span>
                                        </td>
                                    @elseif($quiz->publish_status==1)
                                        <td>
                                                <span class="label label-success"> Published
                                                &nbsp;
                                                <a  class="btn btn-danger"
                                                    href="{{ route('UnpublishQuiz',['id'=>he($quiz->id)]) }}">Un-Publish</a>
                                                    </span>
                                        </td>
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




