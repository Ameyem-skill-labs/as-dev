@extends('layouts.app')
@section('content')

<?php  $questions = $quiz_data->question;
$i = 1; ?>

<div class="container"> 
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="text-center"><hr>Answer the questions<hr></h3>
            <h4>Time left for submission: <span id="timestamp"></span></h4>
        </div>
    </div>
</div>

<div class="container"> 
    <form id="questions_container" action="" method="post">
        {{ csrf_field() }}
        <input type="hidden" value="{{ he($quiz_data->chapter_id) }}" name="chapter_id">
    
        @foreach($questions as $question)
            <div class="panel  panel-default quiz_table">
                <div class="panel-heading">
                    <span class="qbox">{{ $i++ }} )</span>
                    <span class='question'>{!! $question->question !!}</span>
                </div>
                <div class="">
                    <table class="table table-responsive">
                        <tr>
                            <td>
                                <input type="radio" name="{{ he($question->id) }}" class="button btn btn-default" value="A"  required> <span class='optionA'>{!! $question->optionA !!}</span>
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
            </div>
        @endforeach
        <input id="mySubmit" type="submit" class="button btn btn-primary pull-left" value="Submit answers">
    </form>
</div>

    
<script>

var time4submission=<?php echo(count($questions)); ?>*45000;
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




