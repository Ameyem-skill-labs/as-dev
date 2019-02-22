@extends('layouts.app')
@section('content')

<style>
        #quiz_maker{
                background: white;
        }
        .qbox{
                padding:10px;
                /* margin:5px; */
                color:black;
                font-weight:bold;
                box-shadow: 3px 4px 3px rgba(90, 90, 94, 0.3);
        }
       
        .correct-bg{
                background: #5bc20b;
                color:white;
        }
        .current-bg{
                background: #347AB6;
                color:white;
        }

</style>
<?php 
$i = 0; 
$A = "A";
$B = "B";
$C = "C";
$D = "D";

?>



@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif


<div class="container-fluid"> 
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="text-center">Answer the questions</h3>
                </div>
                <h5>Time left: <b><span id="timestamp"></span></b></h5>

                <div class="panel-body">
                    <div class="row">
                    <span>List Of Questions : </span>
                        @foreach($all_questions as $all_question)
                            <?php 
                            $ques_status = DB::table('online_quiz_statuses')
                            ->where('online_quiz_statuses.online_quiz_question_id',$all_question->id)
                            ->where('online_quiz_statuses.user_id', Auth::user()->id)->count();
                            ?>
                            <!-- {{ $ques_status }} -->
                            @if($ques_status == 1)
                                <a class="btn btn-xs"><span class="qbox correct-bg">{{ ++$i }}</span></a>
                            @elseif($question->id == $all_question->id)
                                <a class="btn btn-xs"><span class="qbox current-bg">{{ ++$i }}</span></a>
                            @else
                                <a class="btn btn-xs"><span class="qbox">{{ ++$i }}</span></a>
                            @endif

                        @endforeach

                            <?php 
                            // its for verify the status of the all questions in the quiz saved in online_quiz_statuses
                            $quiz_status = DB::table('online_quiz_statuses')
                                    ->join('online_quiz_questions','online_quiz_statuses.online_quiz_question_id','=','online_quiz_questions.id')
                                    ->where('online_quiz_questions.online_quiz_id',$quiz_id)
                                    ->where('online_quiz_statuses.user_id', Auth::user()->id)
                                    ->select('online_quiz_statuses.*')->count();
                            $count = $all_questions->count();

                            ?>


                            <form action="{{ route('save_answer',[he($quiz_id),he($question_id)]) }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="panel  panel-default quiz_table">
                                    <div class="panel-heading">
                                        <span class='question'><h4>{!! $question->question !!}</h4></span>
                                    </div>
                                    <table class="table table-responsive">
                                        <tr>
                                            <td>
                                        
                                            <input type="radio" name="{{ he($question->id) }}" class="button btn btn-default" value="A" required> <span class='optionA'>{!! $question->optionA !!}</span>
                                        
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                        
                                            <input type="radio" name="{{ he($question->id) }}" class="button btn btn-default" value="B" required> <span class='optionB'>{!! $question->optionB !!}</span>
                                        
                                            
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            
                                            <input type="radio" name="{{ he($question->id) }}" class="button btn btn-default" value="C" required> <span class='optionC'>{!! $question->optionC !!}</span>
                                    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                        
                                            <input type="radio" name="{{ he($question->id) }}" class="button btn btn-default" value="D" required> <span class='optionD'>{!! $question->optionD !!}</span>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="display:none">
                                                <input type="radio" name="{{ he($question->id) }}" class="button btn btn-default" value="timeout" checked="checked"> Other
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                    @if($quiz_status+1 == $count)
                                    <!-- if count of all questions in  this quiz equal to all questions in online_quiz_statuses table  -->
                                        <!-- <a id="mySubmit" class="btn btn-primary" href="{{ route('viewResult',$quiz_id) }}">Final Submit</a> -->
                                        <input id="mySubmit" type="submit" class="button btn btn-primary pull-left" value="Final Submit">
                                    @else
                                        <input id="mySubmit" type="submit" class="button btn btn-primary pull-left" value="Save & Next">
                                    @endif
                            </form>
                    </div>
                </div>
            </div>
        </div>       
    </div>
</div>


    
<script>

var time4submission=60000;
window.setTimeout(()=>document.getElementById("mySubmit").click(),time4submission+1000) ;
var countDownDate = new Date().getTime() + time4submission;

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
   // console.log(countDownDate)
    //var countDownDate =now+10000;
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
   // var days = Math.floor(distance / (1000 * 60 * 60 * 24));
   // var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    document.getElementById("timestamp").innerHTML = 
   // days + "d " + hours + "h "    + 
    minutes + "m " + seconds + "s ";
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("timestamp").innerHTML = "EXPIRED";
    }
}, 1000);
    </script> 
 
    <script src="https://cdn.ckeditor.com/4.9.2/standard-all/ckeditor.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS_HTML"/></script>
    <script>
		CKEDITOR.replace( 'question','optionA','optionB','optionC','optionD', {
			extraPlugins: 'mathjax',
			mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS_HTML',
			height: 320,
            width: 620
		} );

		if ( CKEDITOR.env.ie && CKEDITOR.env.version == 8 ) {
			document.getElementById( 'ie8-warning' ).className = 'tip alert';
		}
        config.mathJaxClass = 'question','optionA','optionD','optionC','optionD';
	</script>

@endsection




