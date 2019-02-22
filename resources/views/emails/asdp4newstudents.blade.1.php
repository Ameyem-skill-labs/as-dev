

@extends('beautymail::templates.minty',[
    'logo'        => [
            'path'   => "http://skills.ameyem.com/images/logo1.png",
            'width'  => '',
            'height' => '',
        ]]);

@section('content')


    {{--  @include('beautymail::templates.sunny.button', [
        	'title' => 'Click me',
        	'link' => 'http://google.com'
    ])  --}}


	@include('beautymail::templates.minty.contentStart')
		<tr>
			<td class="title">
				Dear {{$name}},
			</td>
		</tr>
		<tr>
			<td width="100%" height="10"></td>
		</tr>
		<tr>
			<td class="paragraph">
				Hope you have learnt something on that day, in a seminar with us. We want to extend our gratitude by 
				extending our support in form of online learning from Ameyem Skill Development program.
			</td>
		</tr>
		<tr>
			<td width="100%" height="25"></td>
		</tr>
		<tr>
			<td class="title">
				Opportunity to learn new skills
			</td>
		</tr>
		<tr>
			<td width="100%" height="10"></td>
		</tr>
		<tr>
			<td class="paragraph">
				We would like to offer a free course on 'Introductory Web Development' and 100 free Ameyem Coins worth 1000 rupees. 
				In future more courses are coming in and more free coins will be available.
			</td>
		</tr>
		<tr>
			<td class="paragraph">
				To grab the opportunity we request you to 
				please register by clicking on following register button.
				During the process select your institute as institute and 'student' for role.
				Wait for a day to start your first course...
				All the best!!!!!!!!!!!!!!!!
			</td>
		</tr>
		<tr>
			<td class="paragraph">
				You can look at the downloads section at https://www.ameyem.com/asdp for 'how to use this portal as student' 
				and the presentation we have given on that day in your college.
			Hope you will gain immensely with association with us. Feel free to contact (0866-2470778) for guidance on your career. It is obsolutely free. 
			We also plan to conduct free seminars in future, which will be informed in the same mail.

			</td>
		</tr>
		<tr>
			<td width="100%" height="25"></td>
		</tr>
		<tr>
			<td>
				@include('beautymail::templates.minty.button', ['text' => 'Register', 'link' => 'https://www.ameyem.com/asdp/register'])
			</td>
		</tr>
		<tr>
			<td width="100%" height="25"></td>
		</tr>
		<tr>
			<td class="title">
				All the best for your successful career...
			</td>
		</tr>
		<tr>
			<td class="paragraph">
				Best Regards, <br>
				HR, Ameyem Skill Labs, <br> Vijayawada.<br>
				Ph: 0866-2470778 <br>
				<h2 style="color:green">Contact for Offline Training: +91-8800197778<h2>
			</td>
		</tr>
		<tr>
			<td width="100%" height="25"></td>
		</tr>
	@include('beautymail::templates.minty.contentEnd')
	

@stop


{{--  

@extends('beautymail::templates.ark')

@section('content')

    @include('beautymail::templates.ark.heading', [
		'heading' => 'Hello World!',
		'level' => 'h1'
	])

    @include('beautymail::templates.ark.contentStart')

        <h4 class="secondary"><strong>Hello World</strong></h4>
        <p>This is a test</p>

    @include('beautymail::templates.ark.contentEnd')

    @include('beautymail::templates.ark.heading', [
		'heading' => 'Another headline',
		'level' => 'h2'
	])

    @include('beautymail::templates.ark.contentStart')

        <h4 class="secondary"><strong>Hello World again</strong></h4>
        <p>This is another test</p>

    @include('beautymail::templates.ark.contentEnd')

@stop 



@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => 'Hello!',
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')

        <p>Today will be a great day!</p>

    @include('beautymail::templates.sunny.contentEnd')

    @include('beautymail::templates.sunny.button', [
        	'title' => 'Click me',
        	'link' => 'http://google.com'
    ])

@stop


 --}}