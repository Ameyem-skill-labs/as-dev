@extends('layouts.app')


@section('content')


<div class="container">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ url('/register') }}"> Back</a>
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
</div>
    <!--,'files'=>true ,'enctype'=>"multipart" -->

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div style="color:white" class="panel-heading"><center>Add New College Details</center></div>

                    <div class="panel-body">
        
                            {!! Form::open(array('route' => 'institutes.store','method' => 'POST')) !!}
                            <div class="row">

                            <!-- {{ csrf_field() }} -->
                                
                                
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>College Name</strong>
                                            {!! Form::text('name',  null, array('placeholder' => 'Enter Your College Name','class' => 'form-control')) !!}
                                    
                                    </div>
                                </div>
                                
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>City Name</strong>
                                            {!! Form::text('city',  null, array('placeholder' => 'Enter Your City Name','class' => 'form-control')) !!}
                                    
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Address</strong>
                                            {!! Form::text('address',  null, array('placeholder' => 'Enter Your College Address','class' => 'form-control')) !!}
                                    
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


@endsection