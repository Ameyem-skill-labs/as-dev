
<style>
    #course_list{
        background: white;
    }
</style>

    <div class="container" id="course_list">


        <h2 class="text-center">Courses by You</h2>
        <br>
            @if(!count($mentor_courses)>0)
            <div class="row text-center">
            <h3>You dind't create any course so far</h3>
            <h4> Please Create New Course</h4>
        
            </div>
            @endif
        {{--print errors--}}
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach

        {{--print messages after form submit--}}
        {{--  @if(Session::has('message'))
            <br>
            <div class="row">
                <div class="col-md-8 col-md-offset-2" id="flash_message">
                    <div class="alert alert-{{Session::get('type')}} alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <p class="text-center">
                            <span class="text-center">{{Session::get('subject')}}</span>
                            click
                            <a href="{{route('courses')}}"><strong>here</strong></a>
                            to add chapters</span>
                        </p>
                    </div>
                </div>
            </div>
        @endif  --}}
        <div class="table-responsive">
        <table class="table table-hover">
            @foreach($mentor_courses as $course)
            <tr>
                <td>
                   <b>{{$course['name']}}</b>
                </td>
                <td>
                    {{$course['description']}}
                </td>
                <td style="color:#347ab7"><a href="" onclick="return alert('List Of Enrolled Students : {{$course['student_list']}}')">Enrols:{{$course['enroll']}}</a></td>
                <td>
                    <a  class="btn btn-primary"
                        href="{{ route('manageCourse',['id'=>he($course->id)]) }}">Manage</a>
                </td>
                <td>
                    <a  class="btn btn-primary"
                        href="{{ route('editCourse',['id'=>he($course->id)]) }}">Edit</a>
                </td>
                <!-- <td>
                    <a  id = "FormDeleteTime" class="btn btn-danger"
                       href="{{ route('deleteCourse',['id' =>he($course->id)]) }}">Delete</a>
                </td> -->
                <td>

                    @if($course->status==0)
                        <td>
                                <span class="label label-warning"> New
                                &nbsp;
                                <a  class="btn btn-primary"
                                    href="{{ route('publishCourse',['id'=>he($course->id)]) }}"> Publish</a>
                                </span>
                        </td>
                    @elseif($course->status==1)
                        <td>
                                <span class="label label-success"> Published
                                &nbsp;
                                <a  class="btn btn-danger"
                                    href="{{ route('UnpublishCourse',['id'=>he($course->id)]) }}">Un-Publish</a>
                                    </span>
                        </td>

                    @elseif($course->status==2)
                        <td>
                                <span class="btn btn-danger">Changes Required
                                    &nbsp;
                                </span>
                        </td>
                    @endif
                
                </td>
            </tr>
            @endforeach
        </table>
        </div>
    </div>
    <br>
    
    <script>
        $("#flash_message").delay(1000).slideUp();

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



