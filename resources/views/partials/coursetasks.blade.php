<?php
use App\AdminTasks;
$admin_tasks = AdminTasks::orderBy('id','DESC')
                        ->where('admin_tasks.institutes_id',Auth::user()->institutes_id)
                        ->where('admin_tasks.user_id',Auth::user()->id) 
                        ->paginate(15);
       $i=0;                 
?>
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
                            {{--  <a class="btn btn-success btn-xs" href="{{ route('mentorController.pinTask',$task->id,$task->id) }}">Pin Task</a>  --}}
                            <a href="{{ route('pinTask',['id'=>$chapter_id,'task_id'=>$task->id]) }}" class="button btn btn-primary">Pin Task</a>
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