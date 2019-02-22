@extends('layouts.app')
@section('content')

<div class="row">
      <div class="cover">
                
                <div class="panel panel-success transparent">                       
                        <div class=" panel-heading">
                            <h2 class="text-center  text-uppercase">{{$course->name}}</h2>                      
                        </div>
                        <div class=" panel-body transparent2">
                            <h2 class="text-left"> Rules &amp; Instructions for Course<h2>
                            <h4 class="text-justify">{{$course->description}}</h4>
                        </div>
                </div>                         
                        
            </div>
                        
</div>

                        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {{--course creation form--}}
                {{--  action="{{ route('updateChapter',['id'=>he($chapter->id)]) }}"  --}}
                
                <form action="{{ route('feedback',['id'=>he($course->id)]) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                   {{ csrf_field() }}
                            <div class="col-xs-12 col-sm-12 col-md-12" style="color:green">
                             <h2 class="text-left"> It is must for you to submit the feed back to get maximum bonus credits..<h2>
                                    <div class="form-group">

                                         <div class="col-xs-12 col-sm-12 col-md-6 ">
                                         {!!  Form::input('number', 'guide_rating', null, ['id' => 'weight', 'placeholder'=>"Rate your Guide*",'class' => 'form-control', 'min' => 1, 'max' => 10]) !!}    
                                        </div>
                                        
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                         {!!  Form::input('number', 'reviewer_rating', null, ['id' => 'weight','placeholder'=>"Rate your Reviewer*", 'class' => 'form-control', 'min' => 1, 'max' => 10]) !!}    
                                        </div>
                                        <hr>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                         {!!  Form::input('number', 'course_rating', null, ['id' => 'weight','placeholder'=>"How strong you recommend this course to others*", 'class' => 'form-control', 'min' => 1, 'max' => 10]) !!}    
                                       </div> 

                                       <hr>   
                                       <div class="col-xs-12 col-sm-12 col-md-12"> 
                                         {!!  Form::textarea('comment', null, array('class' => 'form-control','size' => '50x5','placeholder'=>"Give suggesions on how to improve the course?*")) !!}    
                                        </div>
                                        <hr>                                    
                                     </div>
                                <input type="submit" class="btn btn-primary " id="submit_btn" style="float: left" value="Submit" required>
                                    
                            </div> 
                </form>
            </div>

        </div>{{--end row--}}
@endsection