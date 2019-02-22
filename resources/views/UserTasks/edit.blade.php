@extends('layouts.app')
@section('content')

<style>
.mytext{
    border:0;padding:10px;background:whitesmoke;
}
.upload{
    padding-left:18px;
}
.text{
    width:75%;display:flex;flex-direction:column;
}
.text > p:first-of-type{
    width:100%;margin-top:0;margin-bottom:auto;line-height: 13px;font-size: 12px;
}
.text > p:last-of-type{
    width:100%;text-align:right;color:silver;margin-bottom:-7px;margin-top:auto;
}
.text-l{
    float:left;padding-right:10px;
}        
.text-r{
    float:right;padding-left:10px;
}
.avatar{
    display:flex;
    justify-content:center;
    align-items:center;
    width:25%;
    float:left;
    padding-right:10px;
    background:white;
    border-radius: 20%
}
.macro{
    margin-top:5px;width:80%;border-radius:5px;padding:5px;display:flex;
}
.msj-rta{
    float:right;background:white;
}
.macro1{
    margin-top:0px;width:100%;border-radius:0px;padding:0px;display:flex;
}
.msj{
    float:left;background:white;
}
.frame{
    background:#e0e0de;
    height:300px;
    overflow:hidden;
    padding:0;
}
.frame > div:last-of-type{
    position:absolute;bottom:0;width:100%;display:flex;
}
body > div > div > div:nth-child(2) > span{
    background: whitesmoke;padding: 10px;font-size: 21px;border-radius: 50%;
}
body > div > div > div.msj-rta.macro{
    margin:auto;margin-left:1%;
}
.ul {
    width:100%;
    height:100%;
    list-style-type: none;
    padding:18px;
    position:absolute;
    bottom:107px;
    display:flex;
    flex-direction: column;
    top:0;
    overflow-y:scroll;
}
.msj:before{
    width: 0;
    height: 0;
    content:"";
    top:-5px;
    left:-14px;
    position:relative;
    border-style: solid;
    border-width: 0 13px 13px 0;
    border-color: transparent #ffffff transparent transparent;            
}
.msj-rta:after{
    width: 0;
    height: 0;
    content:"";
    top:-5px;
    left:14px;
    position:relative;
    border-style: solid;
    border-width: 13px 13px 0 0;
    border-color: whitesmoke transparent transparent transparent;           
}  
input:focus{
    outline: none;
}        
::-webkit-input-placeholder { /* Chrome/Opera/Safari */
    color: #d4d4d4;
}
::-moz-placeholder { /* Firefox 19+ */
    color: #d4d4d4;
}
:-ms-input-placeholder { /* IE 10+ */
    color: #d4d4d4;
}
:-moz-placeholder { /* Firefox 18- */
    color: #d4d4d4;
}  
</style>
<div class="app">
    <div class="container-fluid">
        <div class="pull-right">
            <a  class="btn btn-success" href="{{ URL::previous()}}">Back</a> 
        </div>

        <div class="row">
        <div class="col-sm-4 col-xs-4 col-md-4 col-lg-4">

        </div>
            <div class="card card-hover bg-success  col-xs-12 col-sm-6 col-md-4">
                
                <div class="card-body">
                    <div class="table-responsive">
           
                        <h3 class="card-title"><center><b>{{ucfirst($task_details->worknature)}}</b></center></h3>
                        <b>Subject</b> : {{$task_details->subject}}
                            <p><b>Title</b> : {{$task_details->worktitle}}</p>
                            <p><b>Description</b> : {{$task_details->workdescription}}</p>
                                @if ($task_details->uploads)
                                    <b>Files to download</b>
                                    <label><a class="btn btn-info btn-xs" href="{{ route('download',$task_details->uploads) }}">Download</a></label>
                                @endif
                            <div>
                                <p class="btn btn-primary"> User Credits: {{$task_details->usercredits}}</p>
                                {{--  <p class="btn btn-primary"> Guide Credits: {{$task_details->guidecredits}}</p>
                                <p class="btn btn-primary"> Reviewer Credits: {{$task_details->reviewercredits}}</p>  --}}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-lg-12 margin-tb">
        <div style="text-align:center">
            <h2>Send Your Work</h2>
        </div>
        <div class="pull-right">
              
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 frame">
            <ul class="ul">
                @foreach ($user_tasks as $task)
                    @if($task->first_name==Auth::user()->first_name)
                        <li style="width:100%">
                            <div class="msj macro">  
                                <div class="avatar" style="padding:0px 0px 0px 10px !important">
                                    <div class="container">
                                        <div class="row">
                                            @if(Auth::user()->profilepic == Null) 
                                                <img src="{{route('profileImage',['name'=>'dummy_pic.jpg'])}}" class="img-circle" width="60" height="60">
                                            @else
                                                <img src="{{route('profileImage',['name'=>Auth::user()->profilepic])}}" class="img-circle" width="60" height="60">
                                            @endif
                                        </div> 
                                        <div class="row">
                                            <p>{{$task->first_name}}</p>
                                        </div>
                                    </div>   
                                </div>
                                <div class="text text-l"> 
                                    <p style="color:red">{{$task->request_for}}</p>
                                    <p style="color:green"> {{ $task->message }} </p> 
                                    <p><small>{{$task->created_at}}</small></p>
                                    @if ($task->uploads)
                                        <small><a class="btn btn-info btn-xs" href="{{ route('download',$task->uploads) }}">File</a></small>
                                    @endif 
                                </div>
                            </div>  
                        </li> 

                    @else
                        <li style="width:100%;">   
                            <div class="msj-rta macro">   
                                <div class="text text-r">   
                                    <p style="color:red">{{$task->request_for}}</p>
                                    <p style="color:green"> {{ $task->message }} </p>  
                                    <p><small>{{$task->created_at}}</small></p> 
                                    @if ($task->uploads)
                                        <small><a class="btn btn-info btn-xs" href="{{ route('download',$task->uploads) }}">File</a></small>
                                    @endif   
                                </div>   
                                <div class="avatar" style="padding:0px 0px 0px 10px !important">
                                    <div class="container">
                                        <div class="row">
                                            @if($task->profilepic == Null) 
                                                <img src="{{route('profileImage',['name'=>'dummy_pic.jpg'])}}" class="img-circle" width="60" height="60">
                                            @else
                                                <img src="{{route('profileImage',['name'=>$task->profilepic])}}" class="img-circle" width="60" height="60">
                                            @endif
                                        </div> 
                                        <div class="row">
                                            <p>{{$task->first_name}}</p>
                                        </div>
                                    </div>    
                                </div>  
                            </div>                                 
                        </li> 
                    @endif
                @endforeach
                <br>

                
            @if($assign_tasks->status === 'drop' || $assign_tasks->status === 'approved')
                <div style="padding:0px 20px 30px 20px !important; color:green"> <h3> Completed </h3><br></div>
            @else
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">


                <!-- <div class="container">
                    <div class="row"> -->
                    {!! Form::open(array('route' => 'UserTasks.store','method' => 'POST','files' => true)) !!} 
                        <div>
                            <div class="upload">
                                <input name="uploads" type="file">
                            </div>
                            <div class="msj-rta macro1" >  
                                <div class="text text-l" style="background:whitesmoke !important">
                                    <textarea name="message" cols="20" rows="2" class="mytext" placeholder="Type a message"/></textarea>
                                </div>  
                                <div style="padding:20px;" >
                                    <button class="btn btn-primary" type="submit">
                                        <span class="glyphicon glyphicon-share-alt">Send</span>
                                    </button>
                                </div>  
                            </div>
                        </div>
                                                
                        @if(isset($course_id))
                            <div class="col-xs-12 col-sm-12 col-md-12" style="display:none">
                                <div class="form-group">
                                    {!! Form::text('course_id', $course_id) !!}            
                                </div>
                            </div>
                        @endif

                        <div class="col-xs-12 col-sm-12 col-md-12" style="display:none">
                            <div class="form-group">
                                <strong>Assigned Task Id:</strong>
                                    {!! Form::text('assigntask_id', $assign_tasks->id) !!}   
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12" style="display:none">
                            <div class="form-group">
                                <strong>Request For::</strong>
                                    {!! Form::text('request_for', 'review') !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12" style="display:none">
                            <div class="form-group">
                                <strong>Request By :</strong>
                                    {!! Form::text('request_by', Auth::user()->id) !!}
                            <!-- </div>
                        </div> -->
                    
                    {!! Form::close() !!}

                </div>
            @endif
        </div>
    </div>
</div> 


<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2"> 
            @if($assign_tasks->status === 'drop')
                <h1>Task Dropped</h1>

            @elseif($assign_tasks->status === 'approved')
                <h1>Task Approved</h1>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>User Marks</th>
                            <th>Guide Marks</th>
                            <th>Reviewer Marks</th>                
                        </tr>
                    
                        <tr> 
                            <td>{{ $assign_tasks->user_credits }}</td>
                            <td>{{ $assign_tasks->guide_credits }}</td>
                            <td>{{ $assign_tasks->reviewer_credits }}</td>
                        </tr>

                    </table>
                </div>
            @else
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif                   
            @endif
                            
        </div>
    </div>
</div>





@endsection
