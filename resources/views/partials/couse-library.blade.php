<?php
function makeColor(){
    $color = '#';
    for($i=0;$i<6;$i++){
        $color .= mt_rand(0,9);
    }
    return $color;
}
?>

<link rel="stylesheet" type="text/css" href="{{url('js/toastr.min.css')}}"/>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

<script src="{{url('js/toastr.min.js')}}"></script>
<style>
    .navbar{                            
        margin-bottom:0px !important;
        border-top: 0px;
    }
    #courseList{
        background-color: white !important;
    }
    #courseList .thumbnail{
        height:auto;
        width: 100%;
        max-width: 100%;
        min-height:400px;
    }
    #courseList img{
        height: 150px;
        margin:0px !important;
        min-width: 100%;
    }
    .clear{
        clear: both;
    }
    .btn-enroll{
        bottom:0px;
    }
    .btn-enroll{
        bottom: 30px;
        position: absolute;
        background-color: #d9534f;
        color:white;
    }
    #courseList .caption {
        padding-bottom: 10px !important;
    }
    .toastup{
        padding: 10px;
        color: white;
        position: absolute;
        right: 10px;
        top: 25%;
        border-radius: 10px;
        font-size: 15px;
        display:none;
        z-index: 99;
    }
    .toastup-error{
        background: rgba(255, 34, 12, 0.56);
    }
    .toastup-warn{
        background: rgba(252, 236, 82, 0.56);
    }
    .toastup-success{
        background: rgba(160, 222, 71, 0.56);
    }
</style>
<?php 
    use App\cv;
    $cvs = cv::all();
?>


    <script>
        $('document').ready(function () {
            $(".toastup").delay(1000).slideDown('fast').delay(3000).slideUp();
        });
    </script>

    @if(Session::has('message'))
        <span class="toastup toastup-{{Session::get('type')}}">
                     <span class="toast-heading">
                         <span>
                             <b>{{Session::get('title')}}</b>
                         </span>
                     </span>
                    <hr>
                    {{Session::get('message')}}
                    </hr>
                </span>
    @endif
        <div class="container" id="courseList">
            <hr><h1 class="text-center">Course library</h1>
            <h5 class="text-center">Chance to Enroll ONE Course at a time</h5> <hr>    
            @foreach($courses as $course)
                     @if(isset($course->enrolled ))
                        <div class="col-md-4">
                            <div class="thumbnail">
                                {{--course image--}}
                                <img src="{{route('coverImage',['id'=>$course->cover])}}" alt="">
                                {{--course details--}}
                                <div class="caption">
                                    <h3>{{$course->name}}<small>( {{ $course->cost}} Coins)</small></h3>
                                    <h5>Created By : 
                        
                                        @foreach($cvs as $cv)
                                            @if($course->user_id == $cv->user_id)
                                                <a href="{{route('cvs',$cv->path)}}" target="_blank"><b>{{$course->f_name}}</b></a>
                                            @endif
                                        @endforeach
                                    </h5>
                                    <p style="height:100px;overflow-y:scroll;">{{$course->description}}</p>
                                    <p>Max Credits: {{$course->max_credits}}</p>
                                    <p>Bonus Credits: {{$course->bonus_credits}} (if you complete in 10days)</p><br>
                                    <a href="" class="btn button pull-right clear btn-enroll center-block btn-success" disabled>Enrolled</a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-md-4">
                            <div class="thumbnail">
                                {{--course image--}}
                                <img src="{{route('coverImage',['id'=>$course->cover])}}" alt="">
                                {{--course details--}}
                                <div class="caption">
                                    <h3>{{$course->name}}<small>( {{ $course->cost}} Coins)</small></h3>
                                    <h5>Created By :

                                        @foreach($cvs as $cv)
                                            @if($course->user_id == $cv->user_id)
                                                <a href="{{route('cvs',$cv->path)}}" target="_blank"><b>{{$course->f_name}}</b></a>
                                            @endif
                                        @endforeach
                                        
                                    </h5>
                                    <p style="height:100px;overflow-y:scroll;">{{$course->description}}</p>
                                    <p>Max Credits: {{$course->max_credits}}</p>
                                    <p>Bonus Credits: {{$course->bonus_credits}} (if you complete in 10days)</p><br>
                                    @if($course->status == 1)
                                    <a href="{{route('enroll',['id'=>he($course->id)])}}" class="btn button pull-right clear btn-enroll center-block btn-primary">Enroll</a>
                                    @else
                                    <a class="btn button pull-right clear btn-enroll center-block btn-primary">Course Is Not Ready At</a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endif

            @endforeach
        </div>

