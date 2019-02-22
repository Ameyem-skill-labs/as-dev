@extends('layouts.app')
@section('content')
<?php $i = 1; ?>
<style>
        #quiz_maker{
                background: white;
        }
        .qbox{
                padding:10px;
                margin:10px;
                color:whitesmoke;
                font-weight:bold;
                box-shadow: 3px 4px 3px rgba(90, 90, 94, 0.3);
        }
        .quiz_table{
                border-top:5px solid #E55469;
        }

        .quiz_table table td{
                font-weight: bold;
        }

        body{
                line-height: inherit !important;
        }
        .quiz_table h4{
                margin-top: 2em;
        }

        .wrong-bg{
                background: #F6511D;
                color:white;
        }

        .wrong-border{
                border-top:5px solid #F6511D;
        }

        .correct-border{
                border-top:5px solid #5bc20b;
        }
        .correct-bg{
                background: #5bc20b;
                color:white;
        }

</style>

<div id="wrapper" class="container">
        <a  class="btn btn-primary pull-right" href="{{ URL::previous()}}">Back</a>  
      
                <h1 class="text-center"><hr>Quiz Results<hr></h1>
                <div class="panel">
                        <h2 class="text-center panel-heading">
                                Score :{{ $results['score']}} out of <b>{{ $results['total'] }}</b>
                        </h2>
                        <h3 class="text-center">
                                status: {{$results['status']}}
                        </h3>
                </div>

                @foreach($questions as $question)
                <?php
                if($question->answerd == false){
                        $statusColor = "wrong";
                        $buttonText = "wrong";
                }else{
                        $statusColor = "correct";
                        $buttonText = "correct";
                }
                ?>
        
                <div class="panel panel-default quiz_table {{$statusColor}}-border">
                        <div class="panel-heading">
                                <div class="row">
                                        <span class="qbox {{$statusColor}}-bg">{{ $i++ }} )</span>
                                        <button class="pull-right button btn {{$statusColor}}-bg">Your Answer {{$question->user_answer}} is {{$buttonText}}</button>
                                        <button class="pull-right btn btn-primary">Correct Answer is : {{$question->answer}}</button><br><br>
                                </div>
                                <div class="row">
                                        <span class='question'>{!! $question->question !!}</span>
                                </div>
                        </div>
        
                        <div class="panel-body">
                                <table class="table table-responsive">
                                        <tr>
                                                <td>
                                                        A. <span class='optionA'>{!! $question->optionA !!}</span>
                                                </td>
                                        </tr>
                                        <tr>
                                                <td>
                                                        B. <span class='optionB'>{!! $question->optionB !!}</span>
                                                </td>
                                        </tr>
                                        <tr>
                                                <td>
                                                        C. <span class='optionC'>{!! $question->optionC !!}</span>
                                                </td>
                                        </tr>
                                        <tr>
                                                <td>
                                                        D. <span class='optionD'>{!! $question->optionD !!}</span>
                                                </td>
                                        </tr>
                                </table>
                        </div>
                </div>
        @endforeach               
</div>
<script src="https://cdn.ckeditor.com/4.9.2/standard-all/ckeditor.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS_HTML"/></script>
<script>config.mathJaxClass = 'question','optionA','optionD','optionC','optionD';</script>
@endsection
        