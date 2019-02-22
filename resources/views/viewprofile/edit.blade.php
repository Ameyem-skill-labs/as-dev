@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 style="color:#2471A3">Edit Details</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('viewprofile.index') }}"> Back</a>
            </div>
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

    {!! Form::model($users, ['method' => 'PATCH','route' => ['viewprofile.update', he($users->id)]]) !!}
    <div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>First Name:</strong>
            {!! Form::text('first_name', null, array('placeholder' => 'Enter Your First Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Last Name:</strong>
            {!! Form::text('last_name', null, array('placeholder' => 'Enter Your Last Name','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Roll Number:</strong>
            {!! Form::text('roll_number', null, array('placeholder' => 'Enter Your Roll Number','class' => 'form-control')) !!}
        </div>
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Mobile Number:</strong>
            {!! Form::text('phone_number', null, array('placeholder' => 'Mobile Number','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Date Of Birth:</strong>
            {!! Form::date('dob', null, array('placeholder' => 'Select Date of Birth','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Qualification:</strong>
            {!! Form::text('qualification', null, array('placeholder' => 'Qualification','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Specialization:</strong>
            {!! Form::text('specialization', null, array('placeholder' => 'Specialization','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Marks  :</strong>
            {!! Form::text('marks', null, array('placeholder' => 'Marks in %','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Passed Out:</strong>
            {!! Form::date('passout', null, array('placeholder' => 'select Passout date','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>College Address:</strong>
            {!! Form::text('collegeaddress', null, array('placeholder' => 'Enter College Name and Address','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Home Address:</strong>
            {!! Form::text('homeaddress', null, array('placeholder' => 'Home Address','class' => 'form-control')) !!}
        </div>
    </div>

    <!-- <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                    
            <strong>  Select file to Upload:</strong><br>
                {!! Form::file('profilepic') !!}
                
            </div>
        </div> -->
    

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>


    </div>
    {!! Form::close() !!}


@endsection

