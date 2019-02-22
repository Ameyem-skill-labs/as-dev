
@extends('layouts.app')
<head>
<style>
    #course-wrapper {
        background: white;
        border: 0.5px solid #dfdfdf;
    }
    .alert-red{
        background: #e55469;
        color:white;
    }
</style>

<head>

@section('content')
@if ($message = Session::get('alert'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<body>

    <div class="container" id="course-wrapper">
        <span class="alert alert-red">- Add a new chapter -</span>
        <hr>
        <h1 class="text-center">{{$course->name}}</h1>
        <hr>
        {{--chapter form--}}
        <form action="{{ route('postChapter',['id'=>he($course->id)]) }}" id="chapter_form" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{--chapter name--}}
            <div class="form-group">
                <label for="name">Name of chapter</label>
                <input type="text" name="name" class="form-control" required>
            </div>   
            {{--Chapter instructions--}}
                    <div class="form-group">
                        <label for="name">Instructions</label>
                        <textarea name="instructions" id="instructions" cols="15" rows="4"  class="form-control" 
                         required></textarea>
                    </div>           

            {{--chapter notes editor--}}
            <div class="form-group">
                <label for="notes_editor">Chapter notes</label>
                <div id="notes_editor" name="notes" class="form-control"></div>
            </div>

            {{--chapter Ebooks/presentation--}}
            <div class="form-group">
                <label for="pdfMaterial">Ebooks/presentation</label>
                <input type="file" name="pdfMaterial" class="form-control"  accept="application/pdf">
            </div>

            {{--chapter videos--}}
            <div class="form-group">
                <label for="video_tutorial">Video tutorial</label>
                <input type="file" name="video_tutorial"  class="form-control" accept="video/mp4" >
            </div>

            {{--submit button--}}
            <input type="submit" class="button btn btn-primary btn-lg" style="float:right">
        </form>
        @include('partials.summernotejs')
        
    </div>
    
    </body>
@endsection
<!-- Scripts -->
    


