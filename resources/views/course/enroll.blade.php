@extends('layouts.app')
@section('content')

<div class="row">
                        <div class="col-sm-4 col-sm-offset-1 panel" >
                            <div class="course_header">
                                
                                    <h3>{{ $course->name}} </h3>
                            </div>
                            <hr>
                            <p>{{ $course->description}}</p>
                        </div>
                        
</div>

                        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {{--course creation form--}}
                {{--  action="{{ route('updateChapter',['id'=>he($chapter->id)]) }}"  --}}
                
                <form action="{{ route('enroll',['id'=>he($course->id)]) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                   {{ csrf_field() }}
                   <div class="col-xs-12 col-sm-12 col-md-12" style="color:green">
                        <div class="form-group">
                            <strong>Guide Name</strong>
                            <select name="guide_id" class="form-control">
                                @foreach ($teachers as $teacher)
                                    <option value="{{$teacher->id}}">{{$teacher->first_name}} {{$teacher->last_name}} ({{$teacher->email}}) from 
                                    <?php
                                        $institute_name = DB::table('institutes')
                                        ->join('users','institutes.id','=','users.institutes_id')
                                        ->where('users.id',$teacher->id)
                                        ->select('institutes.*')->get();
                                    ?>
                                        @foreach($institute_name as $ii)
                                            {{$ii->name}}
                                        @endforeach
                                </option>                
                                @endforeach
                            </select>    
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12" style="color:green">
                        <div class="form-group">
                            <strong>Reviewer Name</strong>
                            <select name="reviewer_id" class="form-control">
                                @foreach ($teachers as $teacher)
                                    <option value="{{$teacher->id}}">{{$teacher->first_name}} {{$teacher->last_name}} ({{$teacher->email}}) from  
                                    <?php
                                        $institute_name = DB::table('institutes')
                                        ->join('users','institutes.id','=','users.institutes_id')
                                        ->where('users.id',$teacher->id)
                                        ->select('institutes.*')->get();
                                    ?>
                                        @foreach($institute_name as $ii)
                                            {{$ii->name}}
                                        @endforeach
                                </option>                
                                @endforeach
                            </select>              
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary " id="submit_btn" style="float: left" value="Enroll course" required>

                   
                </form>

                {{--Print the form validation errors--}}
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>

        </div>{{--end row--}}
@endsection