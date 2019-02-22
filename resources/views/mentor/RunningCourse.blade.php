


<!-- @inject('request', 'Illuminate\Http\Request') -->
{{--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>  --}}
@extends('layouts.app')

@section('content')
<style>

    .course_header h3, .course_header .button{
        display: inline-block;
    }
    
    .course_header .label{
        float: right;
        padding: 10px;
    }
    
    .btn-ongoing {
        background: rgba(160, 222, 71, 1);
        color: whitesmoke;
        margin:10px;
        text-shadow: 1px 1px 1px rgba(59, 16, 16, 0.24);
    }

    .btn-failed{
        background: rgb(222, 91, 0);
        color: whitesmoke;
        margin:10px;
        text-shadow: 1px 1px 1px rgba(59, 16, 16, 0.24);
    }

    .past-courses{
        background: #dddddd !important;
    }
    .extStatus{
        background-color:rgb(200, 220, 220);
        height:20px;
        width:100%
    }
    .hunded{
        background-color:green;
        height:20px;
        width:100%;
        
    }

</style>
<script>
   function statusBar(id,width){
       var elem= document.getElementById(id);
            elem.style.height="20px";
            barwidth=Math.round(width*100)+"%"
                elem.style.width=barwidth;
                elem.innerHTML=barwidth;
                elem.style.backgroundColor="green";
   }
            
    </script>
    <div class="container-fluid">
  
    <h2 class="text-center">Progress of Your Classmates </h2>
    <div class="row">
        
        @if(isMentor())
            @foreach($guideEnrolls as $enrollment)

                @if($enrollment->status <2)      
                    <div class="col-sm-3 panel" >
                        <div class="course_header">
                            <h4>{{ $enrollment->name}}
                             <small>({{ $enrollment->first_name}}: {{$enrollment->ph_number}}) </small>
                             Score: {{$enrollment->creds_earned}}</h4>
                            @if($enrollment->ch_completed>0)
                                <span class="label btn-ongoing">In Progress</span>
                                @else
                                <span class="label btn-danger">Enrolled</span>
                            @endif   
                        </div>                                 
                        <div class="extStatus">
                            <div id="intStatus{{he($enrollment->student_id)}}">

                            </div>
                        </div>
                    </div>
                @elseif($enrollment->status == 2 )
                    <div class="col-sm-3 panel past-courses">
                        <div class="course_header">
                        <h4>{{ $enrollment->name}}
                                    <small>({{ $enrollment->first_name}}: {{$enrollment->ph_number}}) </small>
                                    Score: {{$enrollment->creds_earned}}</h4>
                            <span class="label btn-failed">Completed</span>
                            <a href="{{route('Certificate',['id'=>he($enrollment->course->id),'user_id'=>he($enrollment->student_id)])}}" target="_blank"class="label btn-ongoing">Certificate</a>
                        </div>                    
                        <div class="extStatus">
                            <div class="hunded">100%
                            </div>
                        </div> 
                        <h5>Comment: {{$enrollment->comment}}</h5>
                    </div>
                @endif
                @if($enrollment->ch_outof>0)
                <script>statusBar('intStatus{{he($enrollment->student_id)}}',
                 {{$enrollment->ch_completed/$enrollment->ch_outof}})
                </script>
                @endif
            @endforeach
        @else
            @foreach($guideEnrolls as $enrollment)
                @if($enrollment->status <2 && $enrollment->ch_completed>=1)
                    <div class="col-sm-3 panel" >
                        <div class="course_header">
                            <h4>{{ $enrollment->name}}
                             <small>({{ $enrollment->first_name}}) </small>
                             Score: {{$enrollment->creds_earned}}</h4>
                            @if($enrollment->ch_completed>0)
                                <span class="label btn-ongoing">In Progress</span>
                                @else
                                <span class="label btn-danger">Enrolled</span>
                            @endif  
                        </div>                                 
                        <div class="extStatus">
                            <div id="intStatus{{he($enrollment->student_id)}}">
                            </div>
                        </div>
                    </div>       
                @elseif($enrollment->status == 2 )
                    <div class="col-sm-3 panel past-courses">
                        <div class="course_header">
                        <h4>{{ $enrollment->name}}
                                    <small>({{ $enrollment->first_name}}) </small>
                                    Score: {{$enrollment->creds_earned}}</h4>
                            <span class="label btn-failed">Completed</span> 
                        </div>                    
                        <div class="extStatus">
                            <div class="hunded">100%
                            </div>
                        </div> 
                    </div>
                @endif
                @if($enrollment->ch_outof>0)
                <script>statusBar('intStatus{{he($enrollment->student_id)}}',
                 {{$enrollment->ch_completed/$enrollment->ch_outof}})
                </script>
                @endif
            @endforeach
        @endif
    </div>
</div>

 @endsection   

