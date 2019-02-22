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
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
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
                                <li><a href="{{ url('/login') }}"><span style="color:white" class="glyphicon glyphicon-log-in"></span><b style="color:white"> Login</b></a></li>
                                <li><a href="{{ url('/register') }}"><span style="color:white" class="glyphicon glyphicon-user"></span><b style="color:white"> Registration</b></a></li>
                            @endif
                       
                        @endif
                   
                    </ul>
                </div>
            </div>
        </nav>
    </div>


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading"><center><h2>Ameyem Skills Login</h2></center></div>
                
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail id/User Name</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group margin-bottom-3">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                        
                   
                        
                        {{--  <p class="text-center margin-bottom-3">
                            Or Login with
                        </p>

                        @include('partials.socials-icons')  --}}

                    </form>
                    <h6><center>Don't Have Account Please Register Here</center></h6>
                            <div class="form-group margin-bottom-3">
                                <div class="col-md-8 col-md-offset-4">
                                    <button  class="btn btn-success">
                                        <a href="{{ url('/register') }}"><b style="color:white">Register</b></a>   
                                    </button>
                                </div>
                            </div>
                            <br>
                            <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
