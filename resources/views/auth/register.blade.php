@extends('layouts.auth')


@section('content')
<style>
 .navbar .transparent .navbar-inner {
    border-width: 0px;
    -webkit-box-shadow: 0px 0px;
    box-shadow: 0px 0px;
    background-color: rgba(0,0,0,0.0);
    background-image: -webkit-gradient(linear, 50.00% 0.00%, 50.00% 100.00%, color-stop( 0% , rgba(0,0,0,0.00)),color-stop( 100% , rgba(0,0,0,0.00)));
    background-image: -webkit-linear-gradient(270deg,rgba(0,0,0,0.00) 0%,rgba(0,0,0,0.00) 100%);
    background-image: linear-gradient(180deg,rgba(0,0,0,0.00) 0%,rgba(0,0,0,0.00) 100%);
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 <div class="container-fluid">
        <nav class="navbar transparent">
            <div class="navbar-inner">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar">---</span>
                            <span class="icon-bar">---</span>
                            <span class="icon-bar">---</span>                        
                        </button>
                        
                        <a class="navbar-brand" href="{{ url('/') }}">

                            <b style="color:white">{{ config('app.name', 'Laravel') }}</b>

                        </a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
                            
                        </ul>
                        <ul class="nav navbar-nav navbar-right">

                            @if (Route::has('login'))
                
                                @if (Auth::check())
                                    <li><a href="{{ url('/home') }}"><b style="color:white">Home</b></a></li>
                                    <!-- <li><a href="{{ url('/logout') }}"><b>logout</b></a></li> -->
                                @else          
                                    <li><a href="{{ url('/') }}"><span style="color:white" class="glyphicon glyphicon-log-in"></span><b style="color:white"> Login</b></a></li>
                                    <!-- <li><a href="{{ url('/register') }}"><span style="color:white" class="glyphicon glyphicon-user"></span><b style="color:white">Registration</b></a></li> -->
                                @endif
                        
                            @endif
                    
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#role").change(function () {
            if ($(this).val() == "6") {
                $("#bb").show();
            } else {
                $("#bb").hide();
            }
        });
    });

    $(function () {
        $("#branch_id").change(function () {
            if ($(this).val() == -99) {
                $("#branch_input").show();
            } else {
                $("#branch_input").hide();
            }
        });
    });
    $(function () {
        $("#batch_id").change(function () {
            if ($(this).val() == -99) {
                $("#batch_input").show();
            } else {
                $("#batch_input").hide();
            }
        });
    });
</script>


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading"><center><h2>Ameyem Skills Registration</h2></center></div>
                <div class="panel-body">
                {{--  @if(isset($validator))
                      <p>  {{$validator}}<p>
                    @endif  --}}

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        
                        

                        {{--  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">User Name</label>
                            <div class="col-md-6">
                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Username', 'id' => 'name', 'required', 'autofocus']) !!}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>  --}}
                     
                        
                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name" class="col-md-4 control-label">Name</label>
                                <div class="col-md-6">
                                    <div class="col-md-6">
                                        {!! Form::text('first_name', old("first_name"), ['class' => 'form-control', 'placeholder' => 'First Name', 'id' => 'first_name']) !!}
                                        @if ($errors->has('first_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                            

                                    {{--  <label for="last_name" class="col-md-4 control-label">Last Name</label>  --}}
                                    <div class="col-md-6">
                                        {!! Form::text('last_name', old("last_name"), ['class' => 'form-control', 'placeholder' => 'Last Name', 'id' => 'last_name']) !!}
                                        @if ($errors->has('last_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                        </div>

                          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 

                         

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Mobile Number</label>

                            <div class="col-md-6">
                                <input id="password-phone_number" value ="{{ old('phone_number') }}" type="text" class="form-control" name="phone_number" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('institutes_id') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label"> College/Institute Name</label>

                            <div class="col-md-6">
                            
                                <select name="institutes_id" class="form-control" value="{{ old('institutes_id') }}">
                                <?php 
                                use App\institute;
                                $institutes = institute::all(); 
                                ?>
                                <option value="" disabled="disabled" selected="selected">Select</option>
                                    @foreach ($institutes as $institute)
                                    @if($institute->id !=1 )
                                        <option value="{{$institute->id}}">{{$institute->name}} </option>  
                                    @endif    
                                    @if($institute->id ==1 )
                                        <option value="{{$institute->id}}" selected>{{$institute->name}} </option>  
                                    @endif          
                                    @endforeach
                                    
                                </select>

                                    @if ($errors->has('institutes_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('institutes_id') }}</strong>
                                        </span>
                                    @endif
                                <h6>Don't have in this list, Call US to Register at 0866-2470778 </h6>
                                <!-- <a href="{{ route('institutes.index') }}" class="btn btn-success btn-xs">Add New</a>  -->
                                <!-- Here We are adding New Institute deatails, Controller is going to -->
                            
                           
                            </div>
                            
                        </div>

                        
                        <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                            <label for="role_name" class="col-md-4 control-label">Role</label>

                            <div id="role_id" class="col-md-6">

                            <select name="role_id" id="role" class="form-control" value="{{ old('role_id') }}" required>
                                <?php 
                                use Spatie\Permission\Models\Role;
                                
                                $roles = Role::all(); ?>
                                <option value="" disabled="disabled" selected="selected">Select</option>
                                    @foreach ($roles as $role)
                                        @if($role->id >=3 )                                                                        
                                            @if($role->id ==6 )                                        
                                                <option value="{{$role->id}}" selected> {{$role->name}} </option>   
                                            @else
                                                <option value="{{$role->id}}"> {{$role->name}} </option> 
                                            @endif 
                                        @endif             
                                    @endforeach
                                
                            </select>

                                @if ($errors->has('role_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role_id') }}</strong>
                                    </span>
                                @endif

                            
                            </div>
                        </div>
                        

                        <div id="bb" >
                        <div class="form-group{{ $errors->has('branch_id') ? ' has-error' : '' }}">
                            <label for="branch_id" class="col-md-4 control-label">Branch Name</label>

                            <div class="col-md-6">
                            
                            <select id='branch_id' name="branch_id" value="" class="form-control">
                            <?php 
                            use App\Branch;
                            $branches = Branch::all(); ?>
                            <option value="" disabled="disabled" selected="selected">Select Your Branch</option>
                                @foreach ($branches as $branch)
                                @if($branch->id==old('branch_id'))
                                <option value="{{$branch->id}}" selected>{{$branch->name}} </option>  
                                @else
                                    <option value="{{$branch->id}}">{{$branch->name}} </option>    
                                @endif            
                                @endforeach
                                <option value=-99>Other </option>

                            </select>
                            <div id="branch_input"  style="display:none">
                            <input  name="branch_name_in" class="form-control" value="{{ old('branch_name_in') }}"  placeholder="Branch Name">
                            </div>
                                @if ($errors->has('branch_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('branch_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('batch_id') ? ' has-error' : '' }}">
                            <label for="batch_id" class="col-md-4 control-label">Batch Starting Year</label>

                            <div class="col-md-6">
                            
                            <select id='batch_id' name="batch_id" value="" class="form-control">
                            <?php 
                            use App\batch;
                            $batches = batch::all(); ?>
                            <option value="" disabled="disabled" selected="selected">Select Your Batch Starting Year</option>
                                @foreach ($batches as $batch)
                                @if($batch->id==old('batch_id'))
                                <option value="{{$batch->id}}" selected>{{$batch->name}} </option>  
                                @else
                                    <option value="{{$batch->id}}">{{$batch->name}} </option>   
                                @endif             
                                @endforeach
                                <option value=-99>Other </option>
                            </select>
                            <div id="batch_input"  style="display:none">
                            <input  name="batch_name_in" value="{{ old('batch_name_in') }}" class="form-control" placeholder="Batch Year">
                            </div>
                                @if ($errors->has('batch_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('batch_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        </div>





                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" value ="" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
 
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" value ="" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>




                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                                {{--  <span><b>Or</b></span>
                                    
                                        <a class="btn btn-success" href="{{ url('/') }}"><b style="color:white">Login</b></a>   
                                      --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br><br><br><br>
@include("partials.footer")
@endsection
