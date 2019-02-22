<style>
    .main{
        position: fixed;
    }
</style>
<header class="main-header">
    <div class="main">
        <a href="{{ url('/home') }}" class="logo"
        style="font-size: 16px;">
            <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
            <i class="fa fa-adn"></i></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">
            <h3 style="font-family: Times New Roman, Times, serif;">Ameyem</h3>
            </span>
        </a>
    </div>
   
     <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                   
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                   
                    </a>
                    <?php 
                    use App\coinsinout;
                    $coins = coinsinout::where('user_id',
                    Auth::user()->id)->sum('coins');
                    ?>
                    <a class="navbar-brand" href="{{ url('/home') }}">

                        <b style="color:white">{{ config('app.name', 'Laravel') }}( You have: <span style="color:yellow">{{$coins}} coins</span>)</b>
                        

                    </a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        
                    </ul>
                    <ul class="nav navbar-nav navbar-right">


               
                            @if (Auth::check())
                                <!-- <li><a href="{{ route('forumFeed') }}"><b>Forum</b></a></li> -->
                                <li>
                                    <a href="{{ route('UserProfile.show',he(Auth::user()->id)) }}">
                                    <b>Welcome</b>
                                    @if(Auth::user()->profilepic == Null)
                                        <!-- <i class="fa fa-user"></i> -->
                                        <img src="{{route('profileImage',['name'=>'dummy_pic.jpg'])}}" alt="" class="img-rounded" height="25" width="25">
                                    @else
                                        <img src="{{route('profileImage',['name'=>Auth::user()->profilepic])}}" alt="" class="img-rounded" height="25" width="25">
                                    @endif
                                    <span class="title"><b></b></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#logout" onclick="$('#logout').submit();">
                                        <span class="title"><b>Logout</b></span>
                                    </a>
                                </li>
                             
                            @endif          

                   
                    </ul>
                </div>
            </div>
        </nav>



    



        
</header>


