<!-- @inject('request', 'Illuminate\Http\Request') -->
{{--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>  --}}
@extends('layouts.app')

@section('content')
<style>

.frame{
    background:#ffffff;
    height:150px;
    overflow:none;
    padding:0;
}

.ul {
    width:100%;
    height:50%;
    list-style-type: none;
    padding-top:0px;
    position:absolute;
    bottom:107px;
    display:;
    flex-direction: ;
    top:230px;
    overflow-y:scroll;
}
.macro{
    margin-top:20px;width:100%;border-radius:5px;padding:5px;display:;
}
.msj-rta{
    float:left;background:white;
}


</style>

<?php
    use App\AssignTasks;
    $review = AssignTasks::orderBy('id','DESC')->where('assign_tasks.status','review')->where('assign_tasks.guide_id',Auth::user()->id)->count();
?>
@if ($message = Session::get('alert'))
    <div class="alert alert-danger">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <h3 class="text-center">How to complete a course? : <a class="btn btn-sm btn-default" href="{{ route('download',"Course-Guide.pdf") }}">Download</a></h3>
        <h5>Communicative English : <a class="btn btn-xs btn-success" href="{{ route('download',"English.pdf") }}">Download</a></h5>
        <!-- "/download/Course-Guide.pdf"  -->
        </div>
        
    </div>
</div>



<div class="container-fluid">
<div class="row">

    <div id="social-links">

        <div class="col-md-8 col-md-offset-2">
            <ul>        
                <label style="font-size:1em">Share with friends...</label>        
                <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.ameyem.com/asdp" img="/public/share.png" class="social-button " id=""><span class="fa fa-facebook-official" style="font-size:24px"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="https://twitter.com/intent/tweet?text=Excellent portal I found for learning new courses. Want to share with you. &amp;url=https://www.ameyem.com/asdp" class="social-button " id=""><span class="fa fa-twitter" style="font-size:24px"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="https://plus.google.com/share?url=https://www.ameyem.com/asdp" class="social-button " id=""><span class="fa fa-google-plus" style="font-size:24px"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=https://www.ameyem.com/asdp&amp;title=Excellent portal I found for learning new courses. Want to share with you. &amp;summary=dit is de linkedin summary" class="social-button " id=""><span class="fa fa-linkedin" style="font-size:24px"></span></a>
            </ul>
        </div>
    </div>
</div>
            
            
            @if(isAdmin())
            <div class="row">
            <a class="btn btn-default" value='review' href="{{ route('TaskMigrate.show','review') }}">No.of tasks to be Guide :{{$review}}</a>
            </div>
            <!-- <li>
                <a href="{{ route('ReviewCV') }}">
    
                    <i class="fa fa-male"></i>
                    <span class="title">Mentors</span>
                </a>
            </li>
            <li>
                <a href="{{ route('Allcourses') }}">
          
                    <i class="	fa fa-folder"></i>
                    <span class="title">Courses</span>
                </a>
            </li>
            <li>
                <a href="{{ route('Allstudents') }}">
              
                    <i class="fa fa-users"></i>
                    <span class="title">Students</span>
                </a>
            </li> -->
            <div class="row"><h1 style="color:green">Total Users :<span style="color:#347ab7">{{$users->count()}}</span></h1></div>
            <div class="container-fluid">
                <div class="row">
                    <ul class="ul">
                        <div class="col-sm-12">
                            <!-- <li style="width:100%;">    -->
                                <div class="msj-rta macro"> 
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tr style="color:#2471A3">
                                                <th>User Name</th>
                                                <th>Email</th>
                                                <th>Institute</th> 
                                                <th>Role</th>
                                                <th>Phone</th>
                                                <th>Created At</th>
                                            </tr>
                               
                                            @foreach ($users as $key => $user)
                                            
                                            <tr style="color:454545">
                                            
                                                <td>{{ $user->first_name}}{{ $user->last_name }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->iname }}</td> 
                                                <td>{{ $user->rname }}</td>
                                                <td>{{ $user->phone_number }}</td>
                                                <td>{{ $user->created_at }}</td>
                                            </tr>
                                            @endforeach
                                
                                        </table>
                                    </div>
                                </div>
                            <!-- </li> -->
                        </div>
                    </ul>
                </div>
            </div>
            <div style="height=250px">
            </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <div class="container">
        

            <!-- <h1>Total Users : {{$users}}</h1> -->

            
            @elseif(isMentor())    
                <div class="container">
                    <div class="row">
                        <a class="btn btn-default" value='review' href="{{ route('TaskMigrate.show','review') }}">No.of tasks to be Guide :{{$review}}</a>
                    </div>
                </div>

                <div class="row">
                    @include('partials.mentorcourses')
                </div>

                <!-- <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h3 class="text-center"><a  class="btn btn-primary" href="{{ route('createCourse') }}">Create New Course</a></h3>
                    </div>
                </div> -->

                <div class="row">
               
                 {{--  @include('partials.mentorcourse')
                 
                 @include('mentor.course')  --}}
                 </div>

                 <div class="row">
                 @include('partials.studentcourses')
                 </div>

                 @if(count($ongoingtasks)>=1)
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class ="table-responsive">
                                <h2 class="text-center">OnGoing Courses and Chapters</h2>
                                <table class="table table-striped">
                                    <tr style="color:#2471A3">
                                        <th>Course</th> 
                                        <th>Chapter</th>
                                        <th>View Chapter</th>
                                        <th>View Work</th>
                                    </tr>
                                    @foreach ($ongoingtasks as $key => $task)
                                    
                                    <tr style="color:454545">
                                        <td>{{ $task->course_name }}</td> 
                                        <td>{{ $task->chapter_name }}</td>   
                                        <td><a class="btn btn-primary btn-xs" href="{{route('viewChapter',['course_id'=>he($task->course_id),'id'=>he($task->chapter_id)])}}"> View Chapter </a></td>
                                        <td><a class="btn btn-success btn-xs" href="{{ route('UserTasks.edit',['id'=>$task->id]) }}">View Work</a></td>
                                    </tr>
                                    @endforeach
                                </table>                               
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                <div class="row">
                 @include('partials.couse-library')
                 </div>


            @elseif(isStudent())
            
                <div class="row">
                 @include('partials.studentcourses')
                </div>
                
                @if(count($ongoingtasks)>=1)
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class ="table-responsive">
                                <h2 class="text-center">OnGoing Courses and Chapters</h2>
                                <table class="table table-striped">
                                    <tr style="color:#2471A3">
                                        <th>Course</th> 
                                        <th>Chapter</th>
                                        <th>View Chapter</th>
                                        <th>View Work</th>
                                    </tr>
                                    @foreach ($ongoingtasks as $key => $task)
                                    
                                    <tr style="color:454545">
                                        <td>{{ $task->course_name }}</td> 
                                        <td>{{ $task->chapter_name }}</td>   
                                        <td><a class="btn btn-primary btn-xs" href="{{route('viewChapter',['course_id'=>he($task->course_id),'id'=>he($task->chapter_id)])}}"> View Chapter </a></td>
                                        <td><a class="btn btn-success btn-xs" href="{{ route('UserTasks.edit',['id'=>$task->id]) }}">View Work</a></td>
                                    </tr>
                                    @endforeach
                                </table>                               
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="row">
                 @include('partials.couse-library')
                 </div>
                 
            
            
            @endif

</div>
@endsection

