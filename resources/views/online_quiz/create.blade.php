@extends('layouts.app')
@section('content')


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('online_quiz.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div style="color:white" class="panel-heading">
                        <center>Create New Quiz</center>
                    </div>

                    <div class="panel-body">
                        <!--,'files'=>true ,'enctype'=>"multipart" -->
                        
                        {!! Form::open(array('route' => 'online_quiz.store','method' => 'POST')) !!}
                        <div class="row">
                        
                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Subject Name :</strong>
                                        {!! Form::text('subject_name', null, array('placeholder' => 'Subject name','class' => 'form-control') ) !!}
                                
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Quiz Name:</strong>
                                        {!! Form::text('quiz_name', null, array('placeholder' => 'Quiz Name','class' => 'form-control')) !!}
                                
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12" style="display:none">
                                <div class="form-group">
                                    <strong>User ID:</strong>
                                        {!! Form::text('user_id', Auth::user()->id) !!}
                                
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </div>
                        {!! Form::close() !!}


                    </div>
                    
                 </div>
            </div>
        </div>
    </div>



@endsection