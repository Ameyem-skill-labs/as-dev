@extends('layouts.auth')

@section('template_title')
	{{ Lang::get('titles.activation') }}
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">{{ Lang::get('titles.activation') }}</div>
					<div class="panel-body">
						<p>{{ Lang::get('auth.regThanks') }}</p>
						<h2>{{ Lang::get('auth.anEmailWasSent',['email' => $email, 'date' => $date ] ) }}</h2>
						<p>{{ Lang::get('auth.clickInEmail') }}</p>
						<p>{{ Lang::get('auth.clickHereResend') }}</p>
						<p>Please check your mail inbox before clicking this link... <a href='/activation'>Resend</a></p>
					{{--  <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">Close</span>
                </a>  --}}
					{{--  {!! Form::open(['route' => 'logout', 'id' => 'logout']) !!}
					<button type="submit" class='btn btn-danger's>Close</button>
					{!! Form::close() !!}  --}}
					<a href="{{ url('/logout') }}" class='btn btn-danger'><b>Close</b></a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection