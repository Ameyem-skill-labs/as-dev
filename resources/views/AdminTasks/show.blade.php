@extends('layouts.app')
 

@section('content')



    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show task</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('AdminTasks.index') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Work Nature:</strong>
                {!! $admin_tasks->worknature !!}
    
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Subject or Language:</strong>
                {!! $admin_tasks->subject !!}                
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Work Title:</strong>
                {!! $admin_tasks->worktitle !!}
                
            </div>
        </div>
       <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Work Description:</strong>
                {!! $admin_tasks->workdescription !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>What In IT For Me:</strong>
                {!!$admin_tasks->whatinitforme  !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Reserved Credits For:</strong><br>
                <strong>User:</strong>
                {!! $admin_tasks->usercredits !!}
                <strong>Guide:</strong>
                {!! $admin_tasks->guidecredits !!}
                <strong>Reviewer:</strong>
                {!! $admin_tasks->reviewercredits !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                    
            <strong>  Select file to Upload:</strong><br>
                {!! $admin_tasks->uploads !!}
                
            </div>
        </div>


        


    </div>


@endsection
