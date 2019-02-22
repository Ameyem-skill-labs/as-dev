<!-- @inject('request', 'Illuminate\Http\Request') -->
{{--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>  --}}
@extends('layouts.app')
@section('content')


<!--<h1>{{Auth::user()->id }}</h1>
<h2>{{Auth::user()->email }}</h2>  -->

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-primary">
                <div style="color:white" class="panel-heading">
                    <center>Welcome to Work Environment</center>
                </div>
          

                <div class="panel-body">
                   
                    @if(Auth::check())
                    {{csrf_field()}} 

                    

                        <!--quick info section -->
                            <div class="row">
                              

                                <div class="col-lg-3">
                                    <div class="panel panel-primary text-center no-boder">
                                        <a style="text-decoration:none;" href="{{ route('UserTasks.index') }}">
                                            <div class="alert alert-info">                                     
                                                <i class="fa fa-pencil-square-o fa-3x"></i>
                                                <h3>User Tasks </h3>
                                            </div>
                                        </a>
                                        <div class="panel-footer">
                                            <span class="panel-eyecandy-title">Total Tasks : {{ $total_user_tasks }}
                                            </span>
                                        </div>
                                    </div>
                                </div>                               
                        

                                
                                <div class="col-lg-3">
                                    <div class="panel panel-primary text-center no-boder">
                                        <a style="text-decoration:none;" href="{{ route('viewprofile.index') }}">
                                            <div class="alert alert-warning">
                                                <i class="fa fa-user fa-3x"></i>
                                                
                                                <h3>Profile</h3>
                                            </div>
                                        </a>
                                            <div class="panel-footer">
                                                <span class="panel-eyecandy-title">See And Update your profile
                                                </span>
                                            </div>
                                    </div>
                                </div>
                            </div>

                            <!--Start of the teacher and Admin section -->

                            @if(Auth::user()->role_id <= 5) 
                            <div class="row">

                                <div class="col-lg-3">
                                    <div class="panel panel-primary text-center no-boder">
                                        <a style="text-decoration:none;" href="{{ route('AdminTasks.index') }}">
                                            <div class="alert alert-success">                                     
                                                <i class="fa fa-pencil-square-o fa-3x"></i>
                                                <h3>Tasks (Create/Edit)</h3>
                                            </div>
                                        </a> 
                                        <div class="panel-footer">
                                            <span class="panel-eyecandy-title">Total Tasks : {{ $totaltasks }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="panel panel-primary text-center no-boder">
                                        <a style="text-decoration:none;" href="{{ route('AssignTasks.index') }}">
                                            <div class="alert alert-info">
                                                <i class="fa fa-angle-right fa-3x"></i>
                                            
                                                <h3>Assigned Tasks</h3>
                                            </div>
                                        </a>
                                        <div class="panel-footer">
                                            <span class="panel-eyecandy-title">Total Assigned Tasks : {{ $totalassigntasks }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="panel panel-primary text-center no-boder">
                                        <a style="text-decoration:none;" href="{{ route('UserProfile.index') }}">
                                            <div class="alert alert-warning">
                                                <i class="fa fa-users fa-3x"></i>
                                                <h3>Profiles</h3>
                                            </div>
                                        </a>
                                        <div class="panel-footer">
                                            <span class="panel-eyecandy-title">Total Users : 
                                            @if(Auth::user()->institutes_id == 1)
                                            {{ $allusers }}
                                            @else
                                            {{ $totalusers }}
                                            @endif

                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="panel panel-primary text-center no-boder">
                                        <a style="text-decoration:none;" href="{{ route('TaskMigrate.index') }}">
                                            <div class="alert alert-danger">
                                                <i class="fa fa-cogs fa-3x"></i>
                                                <h3>Tasks Progress</h3>
                                            </div>
                                        </a>
                                        <div class="panel-footer">
                                            <span class="panel-eyecandy-title">Total Comments : {{ $totalcomments }}
                                            
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <!--end of the teacher and Admin section -->
                            </div>


                    @endif 
                
                     <!-- end of Users Tasks info sectiopn -->
                </div>


            </div>
        </div>
    </div>
</div>


<!--Start of the information regarding teacher or Admin section -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-primary">
                @if(Auth::user()->role_id <= 5)
                <div style="color:white" class="panel-heading"><center>Welcome to Progress Panel of (as) Guide </center></div>
                @else
                <div style="color:white" class="panel-heading"><center>Welcome to Progress Panel of Student </center></div>
                @endif

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-5">
                        @foreach($role as $roles)
                            <h3 style="color:red"> Role : {{$roles->name}} </h3> 
                        @endforeach
                        @foreach($institute_name as $i_name )
                            <h3 style="color:green"> In {{ $i_name->name }} </h3>
                        @endforeach

                            <h3>ASDP Start date : {{ Auth::user()->created_at }}</h3>               
                            <h3>Association with ASDP : {{ $days }} days </h3> 
                            <h3>Completed tasks : {{ $completedtasks}}</h3>
                            <h3>Total Credits : {{ $totalcredits}}</h3>
                            <h3>Dropped Tasks : {{ $droptasks }}</h3>
                        </div>
                        <div class="col-lg-5">
                            {!! $progress_chart->html() !!}
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{!! Charts::assets() !!}
<!-- <div class="app"> -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-primary">
                    <div style="color:white" class="panel-heading">
                        <center>Welcome to Progress Chats</center>
                    </div>
                    <div class="panel-body">
                           
                        <div class="col-md-4">
                            {!! $assign_chart->html() !!}
                        </div>
                        <div class="col-md-4">
                            {!! $completed_chart->html() !!}
                        </div> 
                            
                            
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->

<!-- End Of Main Application -->
{!! Charts::scripts() !!}
{!! $assign_chart->script() !!}
{!! $completed_chart->script() !!}
{!! $progress_chart->script() !!}



@endsection