@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 margin-tb">
            <div class="pull-left">
                <h2></h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('AdminTasks.index') }}"> Back</a>
            </div>
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
                    <center>Update Task</center>
                </div>

                <div class="panel-body">
                    {{-- {!! Form::model($admin_tasks, ['method' => 'PATCH','route' => ['AdminTasks.update', $admin_tasks->id,'files' => true]]) !!} --}}
                    <form action="{{ route('updateTask',['id'=>$admin_tasks->id]) }}" id="chapter_form" method="post" enctype="multipart/form-data">
                        <div class="row">

                     
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
                                    {!! Form::select('worknature', $work_nature, $admin_tasks->worknature, ['class' => 'form-control']);!!}
                                        
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12" style="color:#006699">
                                <div class="form-group">
                                    <strong>Subject or Language:</strong>
                                    {!! Form::select('subject', $subjects,$admin_tasks->subject,['class' => 'form-control']);!!}
                                    
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12" style="color:#006699">
                                <div class="form-group">
                                    <strong>Work Title:</strong>
                                    {!! Form::text('worktitle', $admin_tasks->worktitle, array('placeholder' => 'Work Title','class' => 'form-control')) !!}
                                </div>
                            </div>


                            <div class="col-xs-12 col-sm-12 col-md-12" style="color:#006699">
                                <div class="form-group">
                                    <strong>Work Description:</strong>
                                    {!! Form::textarea('workdescription', $admin_tasks->workdescription, array('placeholder' => 'Work Description','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12" style="color:#006699">
                                <div class="form-group">
                                    <strong>What In IT For Me:</strong>
                                    {!! Form::text('whatinitforme', $admin_tasks->whatinitforme, array('placeholder' => 'What In IT For Me','class' => 'form-control')) !!}
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
                                    <strong>  Select file to Upload:</strong> ( if you upload the new file, old file delete automatically)<br>    
                                        <input type="file" class="form-control" name="uploads" id="uploads">         
                                </div>
                            </div>    

                         

                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>


                        </div>
                    {{--  {!! Form::close() !!} --}}
                    <form>


                </div>
                
            </div>
        </div>
     </div>
</div>


@endsection