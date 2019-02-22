@extends('layouts.app')


@section('content')




    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('AdminTasks.index') }}"> Back</a>
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
                        <center>Create New Task</center>
                    </div>

                    <div class="panel-body">
                        <!--,'files'=>true ,'enctype'=>"multipart" -->
                        
                        {!! Form::open(array('route' => 'AdminTasks.store','method' => 'POST','files' => true)) !!}
                        <div class="row">

                        <!-- {{ csrf_field() }} -->
                            
                            
                            <div class="col-xs-12 col-sm-12 col-md-12" style='display:none'>
                                <div class="form-group">
                                    <strong>Institute ID:</strong>
                                        {!! Form::text('institutes_id', Auth::user()->institutes_id) !!}
                                
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12" style='display:none'>
                                <div class="form-group">
                                    <strong>Assign Task Teacher ID:</strong>
                                        {!! Form::text('user_id', Auth::user()->id) !!}
                                
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12" style="color:#006699">
                                <div class="form-group">
                                    <strong>Work Nature:</strong>
                                    <select name="worknature" class="form-control">
                                        @foreach ($work_nature as $work)
                                            <option value="{{$work->work_nature}}">{{$work->work_nature}}</option>                
                                        @endforeach
                                    </select>
                                
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12" style="color:#006699">
                                <div class="form-group">
                                    <strong>Subject or Language:</strong>
                                    <select name="subject" class="form-control">
                                        @foreach ($subjects as $subject)
                                            <option value="{{$subject->subject}}">{{$subject->subject}}</option>                
                                        @endforeach
                                    </select>
                                    
                                    
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12" style="color:#006699">
                                <div class="form-group">
                                    <strong>Work Title:</strong>
                                    {!! Form::text('worktitle', null, array('placeholder' => 'Work Title','class' => 'form-control')) !!}
                                </div>
                            </div>


                            <div class="col-xs-12 col-sm-12 col-md-12" style="color:#006699">
                                <div class="form-group">
                                    <strong>Work Description:</strong>
                                    {!! Form::textarea('workdescription', null, array('placeholder' => 'Work Description','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12" style="color:#006699">
                                <div class="form-group">
                                    <strong>What Is In IT For Me:</strong>
                                    {!! Form::text('whatinitforme', null, array('placeholder' => 'What they gain','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12" style="color:#006699">
                                <div class="form-group">
                                    <strong>Reserved Credits For:</strong><br>
                                    <strong>User:</strong>
                                    {!! Form::selectRange('usercredits', 5, 10) !!}
                                    <strong>Guide:</strong>
                                    {!! Form::selectRange('guidecredits', 2, 5) !!}
                                    <strong>Reviewer:</strong>
                                    {!! Form::selectRange('reviewercredits', 2, 5) !!}
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12" style="color:#006699">
                                <div class="form-group">
                                        
                                <strong>  Select file to Upload:</strong><br>
                                    <!-- {!! Form::file('uploads') !!} -->
                                    <input type="file" class="form-control" name="uploads" id="uploads"> 
                                    
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