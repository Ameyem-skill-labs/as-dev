@extends('layouts.app')

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

@section('content')
@if ($message = Session::get('alert'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<body>

    {{--rich text editor scripts & styles--}}
    {{--  <link href="/css/summernote.css" rel="stylesheet">
    <script src="/js/summernote.js"></script>  --}}

    <div class="container" id="course-wrapper">
        <span class="alert alert-red">- Edit chapter -</span>
        <a  class="btn btn-primary pull-right" href="{{ url('mentor/courses/manage',['course_id'=>he($chapter->course_id)]) }}">Back</a> 
       
        <hr>

        {{--chapter form--}}
        <form action="{{ route('updateChapter',['id'=>he($chapter->id)]) }}" id="chapter_form" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{--chapter name--}}
            <div class="form-group">
                <label for="name">Name of chapter</label>
                <input type="text" name="name" class="form-control" value="{{$chapter->name}}">
            </div>
             {{--Chapter instructions--}}
                    <div class="form-group">
                        <label for="name">Instructions</label>
                        <textarea name="instructions" id="instructions" cols="15" rows="4" class="form-control" 
                         required>{{$chapter->instructions}}</textarea>
                    </div>

            

            {{--chapter notes editor--}}
            <div class="form-group">
                <label for="notes_editor">Chapter notes</label>
                <div id="notes_editor" class="form-control"></div>
            </div>

            {{--chapter Ebooks/presentation--}}
            
            <div class="form-group">
                <label for="pdfMaterial">Ebooks/presentation</label>
                @if(isset($chapter->pdf))
                {{--  <label for="pdfMaterial">{{$chapter->pdf}}</label>  --}}
                <a href="{{route('serveEbook',['id'=>$chapter->pdf])}}" target="_blank" class="button btn btn-success">Read Ebook</a>
                @endif
                <input type="file" name="pdfMaterial" class="form-control"  accept="application/pdf">
            </div>
            

            {{--chapter videos--}}
            <div class="form-group">
                <label for="video_tutorial">Video tutorial</label>
                @if(isset($chapter->video))
                {{--  <div class="row">  --}}
           {{--video lesson --}}
               <video  controls class="col-md-10 col-md-offset-1" controls preload="auto" data-setup="{}">
                   <source src=" {{route('serveVideo',['id'=>$chapter->video]) }}" type="video/mp4">
                   Your browser does not support the video tag.
               </video>
                 {{--  </div>  --}}
                @endif
                <input type="file" name="video_tutorial"  class="form-control" accept="video/mp4" >
            </div>

            {{--submit button--}}
            <input type="submit" class="button btn btn-primary btn-lg" style="float:left">
        </form>
            
            @include('partials.summernotejs')
            

    </div>

    </body>
@endsection
{{--  <!-- Scripts -->

    <script src="{{ url('js/jquery.js')}}"></script>
    <script src="{{ url('js/popper.js')}}"></script>
    <script src="{{ url('js/bootstrap.js')}}"></script>  --}}


