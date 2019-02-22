@inject('request', 'Illuminate\Http\Request')
<style>
    .main-sidebar{
        position: fixed;
    }
</style>
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li>
                <a href="{{ route('UserProfile.show',he(Auth::user()->id)) }}">
                @if(Auth::user()->profilepic == Null)
                    <!-- <i class="fa fa-user"></i> -->
                    <img src="{{route('profileImage',['name'=>'dummy_pic.jpg'])}}" alt="" class="img-circle" height="25" width="25">
                    @else
                    <img src="{{route('profileImage',['name'=>Auth::user()->profilepic])}}" alt="" class="img-circle" height="25" width="25">
                    @endif
                    <span class="title"><b>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</b></span>
                </a>
            </li>
            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/home') }}">
                    <i class="fa fa-home"></i>
                    <span class="title"><b>Home</b></span>
                </a>
            </li>
            <li class="{{ $request->segment(1) == 'dashboard' ? 'active' : '' }}">
                <a href="{{ url('/dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <span class="title"><b>Dashboard</b></span>
                </a>
            </li>
            
            @can('users_manage')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title"><b>@lang('global.user-management.title')</b></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'permissions' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                            <b> @lang('global.permissions.title')</b>
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                            <b> @lang('global.roles.title')</b>
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                            <b>@lang('global.users.title')</b>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('institute.index') }}">
                    <i class="fa fa-building"></i>
                    <span class="title"><b>Add institute</b></span>
                </a>
            
            </li>            

            @endcan


            
            
            @if(isMentor())  
           <li>
                <a href="{{ route('createCourse') }}">
                
                    <i class="fa fa-book"></i>
                    <span class="title"><b>New Course</b></span>
                </a>
            </li>
            {{--   <li>
                <a href="{{ route('courses') }}">
 
                <i class="fa fa-archive"></i>
                    <span class="title"><b>My courses</b></span>
                </a>
            </li>  --}}

            <li>
                <a href="{{ route('online_quiz.index') }}">
                    <i class="fa fa-list-alt"></i>
                    <span class="title"><b>Quiz Manager</b></span>
                </a>
            </li> 
            <!-- <li><a href="#">Students</a></li>   -->
            @elseif(isAdmin())
            <li>
                <a href="{{ route('ReviewCV') }}">
    
                    <i class="fa fa-male"></i>
                    <span class="title"><b>Mentors</b></span>
                </a>
            </li>
            <li>
                <a href="{{ route('Allcourses') }}">
          
                    <i class="	fa fa-folder"></i>
                    <span class="title"><b>Courses</b></span>
                </a>
            </li>
            <li>
                <a href="{{ route('Allstudents') }}">
              
                    <i class="fa fa-users"></i>
                    <span class="title"><b>Students</b></span>
                </a>
            </li>
            @elseif(isStudent())
           <li>
                <a href="{{ route('UserTasks.index') }}">
               
                    <i class="fa fa-tasks"></i>
                    <span class="title"><b>Tasks</b></span>
                </a>
            </li>
            {{--   <li>
                <a href="{{ route('studentCourses') }}">
                  
                    <i class="fa fa-book"></i>
                    <span class="title"><b>My courses</b></span>
                </a>
            </li>  --}}
            @endif

            <li>
                <a href="{{ route('quizzes') }}">
                    <i class="fa fa-list-alt"></i>
                    <span class="title"><b>Online Quizzes </b></span>
                </a>
            </li>

            <li>
                <a href="{{ route('RunningCourses') }}">
                    <i class="fa fa-book"></i>
                    <span class="title"><b>Progress of Your Classmates</b></span>
                </a>
            </li>

            <li class="{{ $request->segment(1) == 'forumFeed' ? 'active' : '' }}">
                <a href="{{ route('forumFeed') }}">
                    
                    <i class="fa fa-desktop"></i>
                    <span class="title"><b>Forum</b></span>
                </a>
            </li>

            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title"><b>Change password</b></span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title"><b>@lang('global.app_logout')</b></span>
                </a>
            </li>
        </ul>
    </section>
</aside>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">@lang('global.logout')</button>
{!! Form::close() !!}
