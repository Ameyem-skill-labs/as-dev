

@extends('beautymail::templates.minty',[
    'logo'        => [
            'path'   => "http://skills.ameyem.com/images/logo1.png",
            'width'  => '',
            'height' => '',
        ]]);

@section('content')

	@include('beautymail::templates.minty.contentStart')
		<tr>
			<td class="title">
				Dear {{$name}},
			</td>
		</tr>
		<tr>
			<td width="100%" height="10" colspan="4"></td>
		</tr>
		<tr>
			<td class="paragraph" colspan="4">
				Hope you are doing well and we wish to keep your hopes alive. Keeping your excitement in our mind
				we have come up with our first online course.
				It is easy to finish the course. You just read the notes given in each chapter and attempt the task and 
				after doing it, send the results with review comments.
				You may require to install winzip or winrar to send morethan one file for review.
				You can easily do that but if you find difficulty call our customer care on 0866-2470778.
			</td>
		</tr>
		<tr>
			<td width="100%" height="25" colspan="4"></td>
		</tr>
		<tr>
			<td class="title" colspan="4">
				New Course on Web Development
			</td>
		</tr>
		<tr>
			<td width="100%" height="10" colspan="4"></td>
		</tr>
		<tr>
			<td class="paragraph" colspan="4">
				We would like to offer a free course on 'Introductory Web Development' and 100 free Ameyem Coins worth 1000 rupees. 
				In future more courses are coming in and more free coins will be available. Follow the links if you can use...
				</td>
			

		</tr>
		<tr>
			<td width="100%" height="10" colspan="4"></td>
		</tr>
		<tr>
			<td class="paragraph" colspan="2">
				
					@include('beautymail::templates.minty.button', ['text' => 'How to Use this Portal? -Students', 'link' => 'https://www.ameyem.com/asdp/download/ASDP-Welcome-StudentGuide.pdf'])
				</td>
				<td class="paragraph" colspan="2">
					@include('beautymail::templates.minty.button', ['text' => 'How to Use this Portal? -Teacher', 'link' => 'https://www.ameyem.com/asdp/download/ASDP-Welcome-TeacherGuide.pdf'])
				</td>

		</tr>
		<tr>
			<td width="100%" height="10" colspan="4"></td>
		</tr>

		<tr>
			<td class="paragraph" colspan="4">
			Feel free to contact (0866-2470778) for guidance on your career. It is obsolutely free. 
			We also plan to conduct free seminars in future, which will be informed in the similar mail.

			</td>
		</tr>
		<tr>
			<td width="100%" height="15"colspan="4"></td>
		</tr>
		<tr>
			<td colspan="4">
				@include('beautymail::templates.minty.button', ['text' => 'Register', 'link' => 'https://www.ameyem.com/asdp/register'])
			</td>
		</tr>
		<tr>
			<td width="100%" height="25"colspan="4"></td>
		</tr>
		<tr>
			<td class="title" colspan="4"colspan="4">
				Share as you wish
			</td>
			
		</tr>
		<tr>
			<td width="100%" height="25"colspan="4"></td>
		</tr>
		<tr>

				<td class="paragraph" >
				@include('beautymail::templates.minty.button', ['text' => 'Facebook', 'link' => 'https://www.facebook.com/sharer/sharer.php?u=https://www.ameyem.com/asdp'])
				</td>

				<td class="paragraph">
				@include('beautymail::templates.minty.button', ['text' => 'Twitter', 'link' => 'https://twitter.com/intent/tweet?text=Excellent portal I found for learning Computer courses. Want to share with you. &amp;url=https://www.ameyem.com/asdp'])
				</td>

				<td class="paragraph">			
					@include('beautymail::templates.minty.button', ['text' => 'Google+', 'link' => 'https://plus.google.com/share?url=https://www.ameyem.com/asdp'])
				</td>

				<td class="paragraph">
					@include('beautymail::templates.minty.button', ['text' => 'LinkedIn', 'link' => 'http://www.linkedin.com/shareArticle?mini=true&amp;url=https://www.ameyem.com/asdp&amp;title=Excellent portal I found for learning Computer courses. Want to share with you. &amp;summary=dit is de linkedin summary'])
				</td>

		</tr>
		<tr>
			<td width="100%" height="25"colspan="4"></td>
		</tr>

		<tr>
			<td class="paragraph"colspan="4">
				Best Regards, <br>
				HR, Ameyem Skill Labs, <br> Vijayawada.<br>
				Ph: 0866-2470778 <br>
				<h2 style="color:green">Contact for Offline Training: +91-8800197778<h2>
			</td>
		</tr>
		<tr>
			<td width="100%" height="25"colspan="4"></td>
		</tr>
	@include('beautymail::templates.minty.contentEnd')
	

@stop

