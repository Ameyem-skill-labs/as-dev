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
                <a class="btn btn-success" href="{{ url('/home') }}">Back</a>
                <a class="btn btn-success" href="{{ route('AdminTasks.create') }}"> Create New Task</a>
            </div>
        </div>

        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
            <div class="pull-left">
                <h1>
                @foreach ($subjects as $subject)            
                    <a class="btn btn btn-lg" href="{{ route('AdminTasks.show',$subject->subject)}}">{{$subject->subject}}</a>
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




<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr style="color:#660033">
                        <th>No</th>
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
                        <td>{{ ++$i }}</td>
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
                            <a class="btn btn-success btn-xs" href="{{ route('AssignTasks.edit',$task->id) }}">Assign Task</a>

                            {{--  {!! Form::open(['method' => 'DELETE','route' => ['AdminTasks.destroy', $task->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!} 
                            {!! Form::close() !!}  --}}
                        </td>
                        @if ($task->uploads)

                            <?php
                            if(substr($task->uploads,0,3)=='../'){
                                
                                $mystr= str_replace("/", "_", substr($task->uploads,3));
                            }else{
                                $mystr= $task->uploads;
                            }
                            
                            

                            ?>

                        <td><a class="btn btn-info btn-xs" href="{{ route('download',$mystr) }}">FileLinks</a></td>


                        

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
@endsection