<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')   
    
    <style>
.navbar-default {
    background-color: #347AB6;
    border-color: #E7E7E7;
}
</style>

</head>


<body class="hold-transition skin-blue sidebar-mini">

<div id="wrapper">

@include('partials.topbar')
@include('partials.sidebar')


<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            @if(isset($siteTitle))
                <h3 class="page-title">
                    {{ $siteTitle }}
                </h3>
            @endif
            <div class="container-fluid" style="margin-top:50px">
                <div class="row">
                    <div class="col-md-12">

                    @if(Session::has('message'))
                        <?php $msg = json_decode(Session::get('message'))?>

                        <br>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                            @if(isset($msg->type))
                                <div class="alert alert-{{$msg->type}} alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <p class="text-center">
                                        <span class="text-center">{{$msg->subject}}</span>
                                        click
                                        <a href="{{route('courses')}}"><strong>here</strong></a>
                                        to add chapters</span>
                                    </p>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                        
                        @if ($errors->count() > 0)
                            <div class="note note-danger">
                                <ul class="list-unstyled">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @yield('content')

                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">Logout</button>
{!! Form::close() !!}

@include('partials.javascripts')
@include('partials.analytics')
</body>
</html>