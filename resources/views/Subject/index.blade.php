@extends('layouts.app')


@section('content')


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2><u>Add New Subject</u></h2><br>
            </div>
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
    <!--,'files'=>true ,'enctype'=>"multipart" -->
    
    {!! Form::open(array('route' => 'Subject.store','method' => 'POST')) !!}
    <div class="row">

    <!-- {{ csrf_field() }} -->
        
        
        <div class="col-xs-12 col-sm-12 col-md-12" style='display:none'>
            <div class="form-group">
                <strong>User ID:</strong>
                    {!! Form::text('user_id', Auth::user()->id) !!}
            
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Subject:</strong>
                    {!! Form::text('subject',  null, array('placeholder' => 'Enter Your Subject','class' => 'form-control')) !!}
            
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>

       

    </div>
    {!! Form::close() !!}


@endsection