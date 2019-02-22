@extends('layouts.app')
 @section('content')
 
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
            <div class="pull-left">
                <h4 style="color:green">Add New Subject
                <p>
                    <a href="{{ route('Subject.index') }}" class="btn btn-success btn-xs">Add</a>
                </p>
                </h4>          
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ URL::previous() }}">Back</a>
                <a class="btn btn-success" href="{{ route('AdminTasks.create') }}"> Create New Task</a>
            </div>
        </div>

        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
            <div class="pull-left">
                <h1>
                @foreach ($subjects as $subject)         
               
                    <a class="btn btn btn-lg" href="{{ route('taskshow',['subject'=>$subject->subject,'chapter_id'=>$chapter_id])}}">{{$subject->subject}}</a>
                 @endforeach
               </h1>
            </div>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<?php
       $i=0;                 
?>
{{--  'chapter_id','task_id','priority_guide_id','priority_reviewer_id'  --}}
{!! Form::open(array('route' => 'pinTask','method'=>'POST')) !!}
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
            <div class="table-responsive form-group">
            <!-- <h2>Chapter ID : {{$chapter_id}}</h2> -->
                <table class="table table-striped">
                    <tr style="color:#660033">
                        <th>Select</th>
                        <th>Task ID</th>
                        <th>Work Nature</th>
                        <th>Subjects or Language</th>
                        <th>Work Title</th>
                        <th>Work Description</th>
                        <th>What Is In It For Me</th>
                        <th>User</th>
                        <th>Guide</th>
                        <th>Reviewer</th>           
                        <th>Updated_At</th>
                        <!-- <th>Created_At</th> -->
                        
                        <th width="280px">Action</th>
                        <th>File Link<th>
                    </tr>
                    @foreach ($admin_tasks as $key => $task)
                    <tr style="color:#2471A3">
                        <td>
                        <!-- {{!! Form::radio('task_id', $task->id) !!}} -->
                        <input class="radio" type ="radio" name='task_id' value = "{{ $task->id }}"></td>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->worknature }}</td>
                        <td>{{ $task->subject }}</td>
                        <td>{{ $task->worktitle }}</td>
                        <td>{{ $task->workdescription}}</td>
                        <td>{{ $task->whatinitforme}}</td>
                        <td>{{ $task->usercredits}}</td>
                        <td>{{ $task->guidecredits}}</td>
                        <td>{{ $task->reviewercredits}}</td>        
                        <td>{{ $task->updated_at}}</td>
                        <!-- <td>{{ $task->created_at}}</td> -->
                        <td>
                            <!-- <a class="btn btn-info btn-xs" href="{{ route('AdminTasks.show',$task->id) }}">Show</a> -->
                            <a class="btn btn-primary btn-xs" href="{{ route('AdminTasks.edit',$task->id) }}">Edit</a>
                            {{--  <a class="btn btn-success btn-xs" href="{{ route('mentorController.pinTask',$task->id,$task->id) }}">Pin Task</a>  --}}
                            
                            {{--  {!! Form::open(['method' => 'DELETE','route' => ['AdminTasks.destroy', $task->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!} 
                            {!! Form::close() !!}  --}}
                        </td>
                        @if ($task->uploads)
                        <td><a class="btn btn-info btn-xs" href="/download/{{ $task->uploads}}" download="{{ $task->uploads}}">FileLinks</a></td>
                        @else
                        <td>Nill</td>
                        @endif
                    </tr>
                    @endforeach
                </table>
                {!! $admin_tasks->render() !!}
            </div>
        </div>
    </div>
</div>
{{--  
<div class="col-xs-12 col-sm-12 col-md-12" style="color:green">
    <div class="form-group">
        <strong>Recommended Guide Name</strong>
        <select name="priority_guide_id" class="form-control">
            @foreach ($teachers as $teacher)
                <option value="{{$teacher->id}}">{{$teacher->first_name}} </option>                
            @endforeach
        </select>    
    </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12" style="color:green">
    <div class="form-group">
        <strong>Recommended Reviewer Name</strong>
        <select name="priority_reviewer_id" class="form-control">
            @foreach ($teachers as $teacher)
                <option value="{{$teacher->id}}">{{$teacher->first_name}}</option>                
            @endforeach
        </select>              
    </div>
</div>  --}}
<div class="col-xs-12 col-sm-12 col-md-12" style="display:none">
    <div class="form-group">
        <strong>Chapter Id:</strong>
        {!! Form::text('chapter_id',$chapter_id,array('class' => 'form-control')) !!}
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12" >
    <div class="form-group">
        <strong>Time required:</strong>
        {{--  {!! Form::text('time_required',hd($chapter_id),array('class' => 'form-control')) !!}  --}}
    {{Form::number('time_required', 'value',['min'=>1,'max'=>30])}} days
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Pin Task</button>
</div>
{{--  <a href="{{ route('pinTask',['id'=>$chapter_id,'task_id'=>$task->id]) }}" class="button btn btn-primary">Pin Task</a>  --}}
{!! Form::close() !!}
@endsection