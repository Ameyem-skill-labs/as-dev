@extends('layouts.app')
@section('content')


    <style>
        #quiz_maker{
            background: white;
        }
        .qbox{
            background: green;
            padding:10px;
            margin:10px;
            color:whitesmoke;
            font-weight:bold;
            box-shadow: 3px 4px 2px rgba(90, 90, 94, 0.3);
        }
        .quiz_table{
            border-top:10px solid #f4f4f4;
        }


    </style>
    <?php $i = 1; ?>
    <div class="container">
        <div class="pull-right">
        <a class="btn btn-primary"  href="{{ route('online_quiz.index') }}">Back</a>
        </div>
    </div>

    <h1 class="text-center">Quiz maker</h1>
    <div class="container" id="quiz_maker">
        <br>
        <button type="button" class="btn btn-success btn-lg center-block">
        <a href="{{ route('addquestion',$quiz_id) }}"  class="button btn btn-success"><b>Add question</b></a>
        </button>
        <br>
        <div id="questions_container">
            <hr><h3 class="text-left">Questions</h3><hr>
            @foreach($questions as $question)
                <div class="panel panel-default quiz_table">
                   <div class="panel-heading">
                       <span class="qbox">{{ $i++ }} )</span><br><br>
                       <span class='question'>{!! $question->question !!}</span>
                   </div>
                    <div class="panel-body">
                        <table class="table table-hover table-responsive">
                           
                           <tr><th>Option A</th><td><span class='optionA'>{!! $question->optionA !!}</span></td></tr>
                           <tr><th>Option B</th><td><span class='optionB'>{!! $question->optionB !!}</span></td></tr>
                           <tr><th>Option C</th><td><span class='optionC'>{!! $question->optionC !!}</span></td></tr>
                           <tr><th>Option D</th><td><span class='optionD'>{!! $question->optionD !!}</span></td></tr>
                           <tr><th>Answer</th><td><button class="button btn btn-primary">option {{$question->answer}}</button></td></tr>
                           <tr>
                                <th>Options</th>
                                <td>
                                <a href="{{ route('q2Edit',[$quiz_id,$question->id]) }}"  class="button btn btn-success">Edit</a>
                                <a id="FormDeleteTime" href="{{ route('questionDelete',[$quiz_id,$question->id]) }}"  class="button btn btn-danger">Delete</a>

                                </td>
                            </tr>
                                
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    
       
    <script src="/js/app.js"></script>

    <script>
     $("#FormDeleteTime").click(function (event) {
                 var x = confirm("Are you sure you want to delete?");
                    if (x) {
                        return true;
                    }
                    else {

                        event.preventDefault();
                        return false;
                    }

                });
    </script>
    <script src="https://cdn.ckeditor.com/4.9.2/standard-all/ckeditor.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS_HTML"/></script>
    <script>
		CKEDITOR.replace( 'question', {
			extraPlugins: 'mathjax',
			mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS_HTML',
			height: 250,
            width: 580
		} );
        CKEDITOR.replace( 'optionA', {
			extraPlugins: 'mathjax',
			mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS_HTML',
			height: 250,
            width: 580
		} );
        CKEDITOR.replace( 'optionB', {
			extraPlugins: 'mathjax',
			mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS_HTML',
			height: 250,
            width: 580
		} );
        CKEDITOR.replace( 'optionC', {
			extraPlugins: 'mathjax',
			mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS_HTML',
			height: 250,
            width: 580
		} );
        CKEDITOR.replace( 'optionD', {
			extraPlugins: 'mathjax',
			mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS_HTML',
			height: 250,
            width: 580
		} );
		if ( CKEDITOR.env.ie && CKEDITOR.env.version == 8 ) {
			document.getElementById( 'ie8-warning' ).className = 'tip alert';
		}
        config.mathJaxClass = 'question','optionA','optionD','optionC','optionD';
	</script>

@endsection