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
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ URL::previous() }}">Back</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div style="color:white" class="panel-heading">
                    <center>Update Question</center>
                </div>

                <div class="panel-body">
    
                    <!-- <form action="questionUpdate" class="modal-body" method="post"> -->
                    <form action="{{ route('questionUpdate',['chapter_id'=>$chapter_id,'question_id'=>$quiz_id]) }}" id="chapter_form" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        

                        
                        @foreach($values as $value)
                        <!-- {!! $value->id !!} -->
                        <div class="form-group">
                            <label for="question">Question</label>
                            <textarea name="question" id="question" cols="30" rows="2" class="form-control">{!! $value->question !!}</textarea>
                        </div>

                        
                        <div class="form-group">
                            <label for="optionA">Option A</label>
                            <textarea name="optionA" id="optionA" cols="20" rows="2" class="form-control">{!! $value->optionA !!}</textarea>
                        </div>

                     
                        <div class="form-group">
                            <label for="optionB">option B</label>
                            <textarea name="optionB" id="optionB" cols="20" rows="2" class="form-control">{!! $value->optionB !!}</textarea>
                        </div>

                     
                        <div class="form-group">
                            <label for="optionC">option C</label>
                            <textarea name="optionC" id="optionC" cols="20" rows="2" class="form-control">{!! $value->optionC !!}</textarea>
                        </div>

                   
                        <div class="form-group">
                            <label for="optionD">option D</label>
                            <textarea name="optionD" id="optionD" cols="20" rows="2" class="form-control">{!! $value->optionD !!}</textarea>
                        </div>

                        
                        <div class="form-group">
                            <label for="optionB">Answer</label>
                            <select class="form-control" name="answer">
                                <option value="A">option A</option>
                                <option value="B">option B</option>
                                <option value="C">option C</option>
                                <option value="D">option D</option>
                            </select>
                        </div>
                        @endforeach

                        <div class="modal-footer">
                            <input type="submit" class="button btn btn-submit pull-right">
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>

</div>

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
			height: 150,
            width: 580
		} );
        CKEDITOR.replace( 'optionA', {
			extraPlugins: 'mathjax',
			mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS_HTML',
			height: 150,
            width: 580
		} );
        CKEDITOR.replace( 'optionB', {
			extraPlugins: 'mathjax',
			mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS_HTML',
			height: 150,
            width: 580
		} );
        CKEDITOR.replace( 'optionC', {
			extraPlugins: 'mathjax',
			mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS_HTML',
			height: 150,
            width: 580
		} );
        CKEDITOR.replace( 'optionD', {
			extraPlugins: 'mathjax',
			mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS_HTML',
			height: 150,
            width: 580
		} );
		if ( CKEDITOR.env.ie && CKEDITOR.env.version == 8 ) {
			document.getElementById( 'ie8-warning' ).className = 'tip alert';
		}
        config.mathJaxClass = 'question','optionA','optionD','optionC','optionD';
	</script>

@endsection