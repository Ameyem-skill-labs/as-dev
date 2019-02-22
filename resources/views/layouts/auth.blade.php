<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <style>
.navbar-default {
    background-color: #347AB6;
    border-color: #E7E7E7;
}
 body{margin:0;height:100%;
 }
canvas{
    position:absolute;top:0;left:0;
    height=200%;
    background-image: linear-gradient(bottom, rgb(105,173,212) 0%, rgb(23,82,145) 84%);
    background-image: -o-linear-gradient(bottom, rgb(105,173,212) 0%, rgb(23,82,145) 84%);
    background-image: -moz-linear-gradient(bottom, rgb(105,173,212) 0%, rgb(23,82,145) 84%);
    background-image: -webkit-linear-gradient(bottom, rgb(105,173,212) 0%, rgb(23,82,145) 84%);
    background-image: -ms-linear-gradient(bottom, rgb(105,173,212) 0%, rgb(23,82,145) 84%);
    
    background-image: -webkit-gradient(
        linear,
        left bottom,
        left top,
        color-stop(0, rgb(105,173,212)),
        color-stop(0.84, rgb(23,82,145))
    );
}


</style>

</head>

<body class="page-header-fixed">
<canvas id="canvas" ></canvas>
    <script src="js/snow.js"></script>

    <!-- <div style="margin-top: 3%;"></div> -->

    <div class="container-fluid">
        @yield('content')
    </div>

    <div class="scroll-to-top"
         style="display: none;">
        <i class="fa fa-arrow-up"></i>
    </div>

    @include('partials.javascripts')
@include('partials.analytics')

</body>
</html>