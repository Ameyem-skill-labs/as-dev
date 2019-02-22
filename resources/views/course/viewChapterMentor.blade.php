@extends('layouts.app')
 <link rel="stylesheet" href="/css/card.css">
<style>
    #chapter_data{
        background: white;
    }
    .label-chapter{
        background: #141204;
        font-size:16px !important;
        font-weight: 400px;
    }
    #notes{
        overflow-y: auto;
    }

    .cover{
        padding:100px;
        background: url({{route('coverImage',['id'=>$chapter->course->cover])}});
        margin-bottom:20px;
        background-size: contain;
    }

    .cover h1{
        background: linear-gradient(rgb(243, 243, 243),rgba(243, 243, 243, 0.55));
        font-weight: 300;
        padding:10px;
    }

    .cover h3{
        background: #f4f4f4;
    }

    .navbar{
        margin-bottom:0px !important;
        border-top: 0px;
    }
    .btn-red{
        background: #432534;
        color:#EFD6AC;
    }
</style>
@section('content')

   <div class="container" id="chapter_data">
       <h2 class="text-center">{{$chapter->name}}</h2> 
        <a  class="btn btn-primary pull-right" href="{{ url('mentor/courses/manage',['course_id'=>he($chapter->course_id)]) }}">Back</a>
                        <hr>
                        <p class="text-justify"><b>Instructions: </b>{{$chapter->instructions}}</p>
        <hr>
        <div class="container text-center">
        <h2 >Tasks to be completed</h2>
        <?php $tcount = 0 ?>
            @foreach($tasks as $task)

            <div class="card card-hover bg-success col-xs-12 col-sm-6 col-md-4">
            {{--  <img class="card-img-top" src="" >  --}}
            <div>
                <div class="card-body ">
                <h3 class="card-title" >{{$tcount+=1}}: {{$task->worktitle}}</h3>
                {{--  <p class="card-text">Task id: {{$task->coursetask_id}}</p>  --}}
                <table class="table table-dark table-hover ">
                <tr>
                    <td>
                    <small>Guide: {{$task->gname}}</small>
                    </td>
                     {{--  </tr>
                     <tr>
                    <td>
                    {{$task->subject}}
                    </td>  --}}
                    <td>
                    <small>Type: {{$task->worknature}}</small>
                    </td>
                
                </tr>
                </table>
                @if(isMentor())
                <p class="card-text">Description: {{$task->workdescription}}</p>
                @if ($task->uploads)
                     {{--  <a class="btn btn-default btn-xs" href="/download/{{ $task->uploads}}" download="{{ $task->uploads}}">File Link</a>  --}}
                     <a class="btn btn-default btn-xs" href="{{ url('download/'. $task->uploads)}}" download="{{ $task->uploads}}">File Link</a>
                @else
                    <a class="btn btn-default btn-xs" href="#" disabled>No File</a>
               
                @endif
                @endif
                {{--  <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>  --}}
                  <div class="card-footer">
                  <p class="card-text">Use: {{$task->whatinitforme}}</p>
                  <p class="label label-chapter"> Max Credits: {{$task->usercredits}}</p>
                  
                  {{--  <p class="label label-chapter">{{$task->guidecredits}}</p>
                  <p class="label label-chapter">{{ $task->reviewercredits}}</p>  --}}
                  {{--  <p class="card-text">Guide: {{$task->gname}}</p>  --}}
                  </div>
                    @if(isStudent() || isMentor())
                        @if(!isset ( $task->status))
                        <a  class="btn btn-warning"                
                            href="{{ route('assigntask',['coursetask_id'=>he($task->coursetask_id),'course_id'=>$chapter->course_id]) }}">Attempt</a>

                        @else
                         
                            @if($task->status!="approved")
                            
                            <a class="btn btn-primary" href="{{ route('UserTasks.edit',['id'=>$task->assigntask_id,'course_id'=>he($chapter->course_id)]) }}">View Work</a>
                            @else
                            <!-- <p class="label label-success">Completed</p> -->
                            <p class="label label-danger "> Earned Credits: {{$task->earned_credits}}</p>
                            <a class="btn btn-success" href="{{ route('UserTasks.edit',['id'=>$task->assigntask_id,'course_id'=>he($chapter->course_id)]) }}">Completed</a>
                            @endif
                        @endif  
                    @endif

                </div>

                </div>

            </div>

            @endforeach
        </div>
       @if(!empty($chapter->video))
       <hr>
       
       <h2 class="text-center">Video tutorial</h2>
       <hr>

       <div class="row">
           {{--video lesson --}}
               <video  controls class="col-md-10 col-md-offset-1" controls preload="auto" data-setup="{}">
                   <source src=" {{route('serveVideo',['id'=>$chapter->video]) }}" type="video/mp4">
                   Your browser does not support the video tag.
               </video>
       </div>
       @endif
       @if(!empty($chapter->pdf))
       <div class="row">
           {{--Chapter Ebooks--}}
           <hr>
           <h2 class="text-center">Ebooks</h2>
           <hr>
           <div>
               <a href="{{route('serveEbook',['id'=>$chapter->pdf])}}" target="_blank" class="col-md-8 col-md-offset-2 button btn btn-red">Read Ebook</a>
           </div>
       </div>
       @endif

       {{--Notes of the chapter--}}
       <hr>
       <h2 class="text-center">Notes</h2>
       <hr>
       <div id="notes">
           {!! $chapter->notes !!}
       </div>
   </div>
@endsection



