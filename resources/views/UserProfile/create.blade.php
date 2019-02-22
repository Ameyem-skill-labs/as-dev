@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
            <div class="pull-left">
                <h2 style="color:#2471A3"></h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ URL::previous() }}"> Back</a>
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

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-primary">
                    <div style="color:white" class="panel-heading"><center><h4>Upload New Profile Image</h4></center></div>

                    <div class="panel-body">
                        {!! Form::open(array('route' => 'UserProfile.store','method' => 'POST','files' => true)) !!}
                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12" style='display:none'>
                                    <div class="form-group">
                                        <strong>Assign Task Teacher ID:</strong>
                                            {!! Form::text('user_id', Auth::user()->id) !!}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <h2 style="color:#347AB6"><label for="name">Select New Profile image</label></h2>
                                        <h4>When you upload a new Image, old image automatically deleted from storage.</h4>
                                        <input type="file" class="form-control" name="profilepic" id="profilepic" required>         
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

