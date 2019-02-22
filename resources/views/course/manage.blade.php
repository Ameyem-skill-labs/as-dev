@extends('layouts.app')
<?php
    function makeColor(){
        $color = '#';
        for($i=0;$i<6;$i++){
            $color .= mt_rand(0,9);
        }
        return $color;
    }
?>
<style>
    .navbar{
        margin-bottom:0px !important;
        border-top: 0px;
    }
    .label-chapter{
        background: #141204;
        font-size:16px !important;
        font-weight: 400px;
    }
    .cover{
        padding:100px;
        background: url({{route('coverImage',['id'=>$course->cover])}});
        margin-bottom:20px;
        background-size: contain;
    }

    .cover h1{
        background: linear-gradient(rgb(243, 243, 243),rgba(243, 243, 243, 0.55));
        font-weight: 300;
        padding:10px;
    }

    .chapter{
        background: linear-gradient(rgba(19, 17, 146, 0),rgba(210, 210, 210, 0.49));
        margin-top: 50px !important;
        color:#101010;
        cursor: pointer;
        border:0px !important;
        border-bottom:2px solid #d1c9e6 !important;
    }

    #manage{
        background: white !important;
    }

    .btn-blue{
        background: #2579A9;
        color:white;
    }

    .btn-preview{
        color:white;
        background:#55286F;
    }

    .btn-quiz{
        background: #d42450;
        color: white;
    }

    .transparent{    
    opacity: 0.8;
    filter: alpha(opacity=80);
}
    .transparent2{    
    opacity: 0.9;
    filter: alpha(opacity=95);
}


</style>
@section('content')

    <?php $count = 0 ?>
    <?php $id= he($course->id)?>
    <div class="row">
        <div class="col-md-10">

            <div class="pull-right">
                <a class="btn btn-success" href="{{ url('/home') }}">Back</a>
            </div>
        </div>
    </div>
        <div class="container">
            <div class="row">
                <div class="panel panel-success transparent">                       
                    <div class=" panel-heading">
                        <h2 class="text-center  text-uppercase">{{$course->name}}</h2>                      
                    </div>
                    <div class=" panel-body transparent2">
                        <h4 class="text-center"> <b><u>Rules &amp; Instructions for Course</u></b><h4>
                        <h4 class="text-justify">{{$course->description}}</h4>
                    </div>
                </div>  
            </div>
        </div>                       
                        
            <!-- </div> -->


            <div class="container" id="manage">
                

                 <div class="col-md-10 col-md-offset-1">
                <h3 class="text-center ">Chapters</h3>
                <hr>
                

                <a  href="{{ route('createChapter',['id'=>$id]) }}"
                    class="center-block button btn-blue btn ">Add new chapter</a>
                <div class="panel-group">
                    @foreach($course->chapter as $chapter)
                        <?php $tcount = 0 ?>
                        
                        <div class="panel panel-default chapter">
                            <p class="label label-chapter"> Chapter{{$count+=1}}</p>
                            
                            @foreach($chapter->tasks as $task)
                            {{--  <p class="label label-success"> {{$task}}</p>  --}}
                            <p class="label label-success"> Task{{$tcount+=1}}</p>
                            @endforeach
                            <h2 class="text-center">
                               {{$chapter->name}} 
                                
                            </h2>
                            <p class="text-justify"><b>Instructions: </b>{{$chapter->instructions}}</p>
        
                            <div class="panel-body">
                                <div class="btn-group inline pull-right">
                                    <a href="{{ route('editChapter',['course_name'=>$course->name,'course_id'=>$id,'id'=>he($chapter->id)])}}" class="button btn btn-blue">Edit </a>
                                    <a href="{{ route('quizMaker',['id'=>he($chapter->id)]) }}" class="button btn btn-quiz">Quiz</a>
                                    <a href="{{ route('taskMaker',['id'=>he($chapter->id)]) }}" class="button btn btn-primary"> Pin Task</a>
                                    <a href="{{route('previewChapter',['course_id'=>$id,'id'=>he($chapter->id)])}}" class="button btn btn-preview"> Preview </a>
                                </div>
                                <div class="btn-group inline pull-left">
                                    <a href="#" class="button btn btn-danger pull-left">Delete</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            </div>
@endsection


