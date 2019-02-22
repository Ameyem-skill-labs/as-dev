@extends('layouts.app')
@section('content')


<div class="container-fluid">   
    <div class="row">
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
            <div class="pull-left">
                <h2 style="color:#2471A3">Hello, Welcome to User Tasks</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ url('/dashboard') }}">Back</a>
            </div>
        </div>
    
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
            <div class="pull-left">
                <h1>
                
                
                <a class="btn btn-info btn-xs" value='review' href="{{ route('TaskMigrate.show','review') }}">To be Reviewed :{{$review}}</a>
                <a class="btn btn-warning btn-xs" value='redo' href="{{ route('TaskMigrate.show','redo') }}">To be Refined :{{$redo}}</a>
                <!-- <a class="btn btn-primary btn-lg" href="{{ route('TaskMigrate.index') }}">To get Started</a> -->
                <a class="btn btn-danger btn-xs" value='drop' href="{{ route('TaskMigrate.show','drop') }}"> Dropped :{{$drop}}</a>
                <a class="btn btn-primary btn-xs" value='review_for_approve' href="{{ route('TaskMigrate.show','review_for_approve') }}"> Review for Approve :{{$review_for_approve}}</a>
                <a class="btn btn-success btn-xs" value='approved' href="{{ route('TaskMigrate.show','approved') }}">Approved :{{$approved}}</a>

               
                </h1>
            </div>
        </div>
    </div>
</div>



<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr style="color:#2471A3">
                        <th>User Name</th>
                        <th>Task Id</th> 
                        <th>Work Title</th>
                        <th>Work Description</th>
                        <th>What In IT For Me</th>
                        <th>User Credits</th>
                        <th>Set By</th>
                        <th>Guide By</th>
                        <th>Review By</th>
                        <th>Assigned Date</th>
                        <th>Updated Date</th>
                        <th>File Link</th>                    
                        <th width="280px">Action</th>
                        <th>Status</th>
                        
                         
                    </tr>
                    @foreach ($assign_tasks as $key => $task)
                    
                    <tr style="color:454545">
                        <td>{{ $task->first_name}} {{ $task->last_name}}</td>
                        <td>{{ $task->task_id }}</td> 
                        <td>{{ $task->worktitle }}</td>
                        <td>{{ $task->workdescription }}</td>
                        <td>{{ $task->whatinitforme }}</td>
                        <td>{{ $task->usercredits}}</td>
                        <td>{{ $task->sname}}</td>
                        <td>{{ $task->gname }}</td>
                        <td>{{ $task->rname}}</td>
                        <td>{{ $task->created_at}}</td>
                        <td>{{ $task->updated_at}}</td>
                        @if ($task->uploads)
                        <td><a class="btn btn-default btn-xs" href="{{ route('download',$task->uploads) }}">Download</a></td>
                        @else
                        <td>Nill</td>
                        @endif
                        <td>
                             <a class="btn btn-info btn-xs" href="{{ route('TaskMigrate.edit',['id'=>$task->id,'task_id'=>$task->task_id]) }}">View Work</a>
                        </td>
                        <td>{{ $task->status }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
                 
@endsection