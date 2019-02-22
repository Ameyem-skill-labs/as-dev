<style>
#course_form{
    background: white;
    border: 0.5px solid #dfdfdf;
}

</style>

<?php                 
use App\course;
if(!isset($course)){                
$course = new course();
$course->id = 0;
$course->name = '';
$course->description ='';  
}
                
?>
    <div class="row">
        <div class="col-md-10">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ URL::previous()}}"> Back</a>
            </div>
        </div>
    </div>
    <div class="container" id="course_form">
         @if($course->id==0)
        <h1 class="text-center">Create a new course</h1>
        @else
        <h1 class="text-center">Edit the course</h1>
        @endif
        <hr>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {{--course creation form--}}
                {{--  action="{{ route('updateChapter',['id'=>he($chapter->id)]) }}"  --}}
                <form action="{{ route('postcourse',['id'=>he($course->id)]) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    {{ csrf_field() }}
                    {{--name of the course--}}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$course->name}}" required>
                    </div>

                    {{--course description--}}
                    <div class="form-group">
                        <label for="name">Description</label>
                        <textarea name="description" id="description" cols="20" rows="10" class="form-control" 
                         required>{{$course->description}}</textarea>
                    </div>

                    {{--course cover--}}
                    @if($course->id==0)
                    <div class="form-group">
                        <label for="name">cover image</label>
                        <input type="file" class="form-control" name="cover" id="cover" required>
                    </div>
                    @endif
                    {{--sumbit button--}}
                    <div class="form-group">
                        <label for="name">Cost</label>
                        <input type="text" class="form-control" name="cost" id="cost" value="{{$course->cost}}" required> Ameyem Coins
                    </div>
                    <input type="submit" class="btn btn-primary " id="submit_btn" style="float: left" value="Submit course" required>

                   
                </form>

                {{--Print the form validation errors--}}
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>

        </div>{{--end row--}}

        <hr>

    </div>
    <br>

