<div class="container">
    @foreach($replies as $reply)
        <div class="panel forumReply">
            <div class="panel-heading">
                <!-- <p class="text-right">{{$reply->user->name}}</p> -->
            </div>
            <div class="panel-content">
                <p>
                <b style="color:orange">{{$reply->user->first_name}} {{$reply->user->last_name}}</b> : {{ $reply->message }} (<b style="color:green"><i>{{$reply->created_at->format('j-F-Y')}}</i></b>)
                </p>
            </div>
        </div>
    @endforeach
</div>
