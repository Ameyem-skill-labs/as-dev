@extends('layouts.app')
@section('content')


<script>
    $('#myDatepicker').datepicker({
        'formatDate': 'Y-m-d H:i:s'
    });
    $('#myDatepicker2').datepicker({
        'formatDate': 'Y-m-d H:i:s'
    });
</script>
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

<br>
<div class="app">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">

                <div class="table-responsive">
                    <div class="panel panel-primary">
                        <div style="color:white" class="panel-heading">
                            <center>Task Details</center>
                        </div>
                            <div class="panel-body" style="color:green">

                                <table class="table table-striped">
                                <tr>
                                    <th>Task Id</th>
                                    <th>Work Nature </th>
                                    <th>Work Title</th>
                                    <th>Work Description</th>
                                </tr>
                                
                                <tr>
                                    <td>{{ $works->id }}</td>
                                    <td>{{ $works->worknature }}</td>
                                    <td>{{ $works->worktitle }}</td>
                                    <td>{{ $works->workdescription }}</td>
                                        
                                </tr>
                            
                                </table>
                        

                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="row">
    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
        <div class="pull-left">
            <h1>
                <a class="btn btn btn-lg" href="{{ route('AssignTasks.edit',$works->id)}}">All Students</a>
                <a class="btn btn btn-lg" href="{{ route('institute.show',$works->id)}}">All Teachers</a>
                @foreach ($branches as $branch)            
                    <a class="btn btn btn-lg" href="{{ route('AssignTasks.show',['bid'=>$branch->id, 'wid'=>$works->id] )}}">{{$branch->name}}</a>
                @endforeach
            </h1>



        </div>
    </div>
</div>

      

<div class="app">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
            
                <div class="panel panel-primary">
                    <div style="color:white" class="panel-heading">
                        <center>Welcome to New Assign Task Environment</center>
                    </div>
                        <div class="panel-body">

                            {!! Form::open(array('route' => 'AssignTasks.store','method'=>'POST')) !!}
                            <div class="row">


                                <div class="col-xs-12 col-sm-12 col-md-12" style="display:none">
                                    <div class="form-group">
                                        <strong>Task Name:</strong>
                                        {!! Form::text('task_id', $works->id,array('class' => 'form-control')) !!}
                        
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12" style="display:none">
                                    <div class="form-group">
                                        <strong>Assign Task Teacher ID :</strong>
                                        {!! Form::text('assign_user_id',Auth::user()->id ,array('class' => 'form-control')) !!}
                        
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong style="color:green">Target Date :</strong>

                                        {!! Form::date('target_at', $targetdate ) !!}

                                    </div>
                                </div>


                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong style="color:green">User Name :</strong><br>
                                        <!-- <select name="user_id" class="form-control"> -->
                                            
                                            <div class="table-responsive">   

                                                <table class="table table-striped">
                                                    <tr style="color:#336699">
                                                        <th>select</th>
                                                        <th>User ID</th>   
                                                        <th>Institute </th>
                                                        <th>Role</th>
                                                        <th>Branch</th>
                                                        <th>Batch</th>
                                                        <th>User Name </th>
                                                        <th>Roll Number</th>
                                                    </tr>
                                                    <h4 style="color:#336699"><input type="checkbox" id="select_all"/> Check all</h4>
                                                    @foreach ($users as $user)

                                                    
                                                    <tr>
                                                    
                                                        <td><input class="checkbox" type ="checkbox" name='user_id[]' value = "{{ $user->id }}"></td>
                                                        <td>{{ $user->id }}</td>
                                                        <td>
                                                            <?php
                                                               
                                                                $institute_name = DB::table('institutes')
                                                                ->join('users','institutes.id','=','users.institutes_id')
                                                                ->where('users.id',$user->id)
                                                                ->select('institutes.*')->get();


                                                                ?>
                                                                @foreach($institute_name as $ii)
                                                                    {{$ii->name}}
                                                                @endforeach
                                                                
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                $role = DB::table('roles')
                                                                ->join('users','roles.id','=','users.role_id')
                                                                ->where('users.id',$user->id)
                                                                ->select('roles.*')->get();
                                                            
                                                            ?>
                                                            @foreach($role as $rr)
                                                                {{$rr->name}}
                                                            @endforeach
                                                        
                                                        
                                                        
                                                        </td>
                                                        <td>
                                                        
                                                            <?php 
                                                                $branch = DB::table('branches')
                                                                ->join('users','branches.id','=','users.branch_id')
                                                                ->where('users.id',$user->id)
                                                                ->select('branches.*')->get();
                                                                
                                                            ?>
                                                            @foreach($branch as $bb)
                                                                {{$bb->name}}
                                                            @endforeach
                                                        
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                $batch = DB::table('batches')
                                                                ->join('users','batches.id','=','users.batch_id')
                                                                ->where('users.id',$user->id)
                                                                ->select('batches.*')->get();
                                                                
                                                            ?>
                                                            @foreach($batch as $bat)
                                                                {{$bat->name}}
                                                            @endforeach
                                                        
                                                        
                                                        </td>
                                                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                                        <td>{{ $user->roll_number }}</td>
                                                    
                                                            
                                                    </tr>
                                                    @endforeach
                                                
                                                </table>
                                            </div>
                                             
                                
                                    </div>
                                </div>
                                
                                <div class="col-xs-12 col-sm-12 col-md-12" style="color:green">
                                    <div class="form-group">
                                        <strong>Guide Name</strong>
                                        <select name="guide_id" class="form-control">
                                            @foreach ($teachers as $teacher)
                                                <option value="{{$teacher->id}}">{{$teacher->name}} , {{$teacher->email}}</option>                
                                            @endforeach
                                        </select>    
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12" style="color:green">
                                    <div class="form-group">
                                        <strong>Reviewer Name</strong>
                                        <select name="reviewer_id" class="form-control">
                                            @foreach ($teachers as $teacher)
                                                <option value="{{$teacher->id}}">{{$teacher->name}} , {{$teacher->email}}</option>                
                                            @endforeach
                                        </select>              
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
    </div>

<script type="text/javascript">

var select_all = document.getElementById("select_all"); //select all checkbox
var checkboxes = document.getElementsByClassName("checkbox"); //checkbox items

//select all checkboxes
select_all.addEventListener("change", function(e){
    for (i = 0; i < checkboxes.length; i++) { 
        checkboxes[i].checked = select_all.checked;
    }
});


for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].addEventListener('change', function(e){ //".checkbox" change 
        //uncheck "select all", if one of the listed checkbox item is unchecked
        if(this.checked == false){
            select_all.checked = false;
        }
        //check "select all" if all checkbox items are checked
        if(document.querySelectorAll('.checkbox:checked').length == checkboxes.length){
            select_all.checked = true;
        }
    });
}

   
</script>




@endsection