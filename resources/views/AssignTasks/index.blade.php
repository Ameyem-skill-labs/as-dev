@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
            <div class="pull-left">
                <span style="color:#2471A3"><h2>Assigned Tasks</h2><h5>Here You can see tasks,only you as a guide</h5></span>
            </div>
             <div class="pull-right">
                <a class="btn btn-success" href="{{ url('/dashboard') }}">Back</a>
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
                <table class="table table-striped" style="color:#2471A3">
                    <tr>
                        <th>No</th>
                        <th>Assign Task ID</th>
                        <th>User Name</th>
                        <th>Guide Name</th>
                        <th>Reviewer Name</th>
                        <th>Status</th>
                        <th>User Marks</th>
                        <th>Guide Marks</th>
                        <th>Reviewer Marks</th>
                        <th>Assigned Date</th>
                        <th>Completion Date</th>
                    </tr>
                    @foreach ($assign_tasks as $key => $task)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->name }}</td>
                            <td>{{ $task->gname }}</td>
                            <td>{{ $task->rname}}</td>
                            <td>{{ $task->status}}</td>
                            <td>{{ $task->user_credits }}</td>
                            <td>{{ $task->guide_credits }}</td>
                            <td>{{ $task->reviewer_credits }}</td>
                            <td>{{ $task->created_at}}</td>
                            <td>{{ $task->completed_at}}</td>
                             <!--  <td>
                                <a class="btn btn-info" href="{{ route('AssignTasks.show',$task->id) }}">Show</a> 
                                <a class="btn btn-primary btn-xs" href="{{ route('AssignTasks.edit',$task->id) }}">Edit</a> 
                                {!! Form::open(['method' => 'DELETE','route' => ['AssignTasks.destroy', $task->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!} 
                            </td>-->
                        </tr>
                    @endforeach
                </table>
                {!! $assign_tasks->render() !!}
            </div>
        </div>
    </div>
</div>

<h5>*Note : If status is empty or NA or initiated means tasks are in starting stage </h5>
@endsection