@extends('layouts.app')

@section('content')




    <!-- <h3 class="page-title">Change password</h3> -->

    @if(session('success'))
        <!-- If password successfully show message -->
        <div class="row">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    @else
        {!! Form::open(['method' => 'PATCH', 'route' => ['auth.change_password']]) !!}
        <!-- If no success message in flash session show change password form  -->
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-primary">

                        <div class="panel-heading"><center><h3>Change Password</h3></center></div>
      

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12 form-group">
                                    {!! Form::label('current_password', 'Current password*', ['class' => 'control-label']) !!}
                                    {!! Form::password('current_password', ['class' => 'form-control', 'placeholder' => '']) !!}
                                    <p class="help-block"></p>
                                    @if($errors->has('current_password'))
                                        <p class="help-block">
                                            {{ $errors->first('current_password') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 form-group">
                                    {!! Form::label('new_password', 'New password*', ['class' => 'control-label']) !!}
                                    {!! Form::password('new_password', ['class' => 'form-control', 'placeholder' => '']) !!}
                                    <p class="help-block"></p>
                                    @if($errors->has('new_password'))
                                        <p class="help-block">
                                            {{ $errors->first('new_password') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 form-group">
                                    {!! Form::label('new_password_confirmation', 'New password confirmation*', ['class' => 'control-label']) !!}
                                    {!! Form::password('new_password_confirmation', ['class' => 'form-control', 'placeholder' => '']) !!}
                                    <p class="help-block"></p>
                                    @if($errors->has('new_password_confirmation'))
                                        <p class="help-block">
                                            {{ $errors->first('new_password_confirmation') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-offset-6">
                                    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
             
@stop
