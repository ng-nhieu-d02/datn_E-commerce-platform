@extends('home.layout.chat')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .friend-list {
        list-style: none;
    }

    .friend-list li {
        border-bottom: 1px solid #eee;
    }

    .friend-list li a img {
        float: left;
        width: 45px;
        height: 45px;
        margin-right: 10px;
    }

    .friend-list li a {
        position: relative;
        display: block;
        padding: 10px 0;
        transition: all .2s ease;
        -webkit-transition: all .2s ease;
        -moz-transition: all .2s ease;
        -ms-transition: all .2s ease;
        -o-transition: all .2s ease;
    }

    .friend-list li.active a {
        background-color: #f1f5fc;
    }

    .friend-list li a .friend-name,
    .friend-list li a .friend-name:hover {
        color: #777;
    }

    .friend-list li a .last-message {
        width: 65%;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        font-size: 1.3rem;
    }

    .friend-list li a .last-message.old {
        text-decoration: none;
        opacity: 0.7;
    }

    .friend-list li a .time {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        right: 20px;
    }

    small,
    .small {
        font-size: 85%;
    }

    .friend-list li a .chat-alert {
        position: absolute;
        right: 8px;
        top: 27px;
        font-size: 10px;
        padding: 3px 5px;
    }

    .chat-message {
        padding: 0px 20px 40px;
        flex: 1;
        overflow: scroll;
        position: relative;
        display: flex;
        flex-direction: column-reverse;
    }

    .chat-message::-webkit-scrollbar {
        display: none;
    }


    .chat {
        list-style: none;
        margin: 0;
    }

    .chat-message {
        background: #f9f9f9;
    }

    .chat li img {
        width: 45px;
        height: 45px;
        border-radius: 50em;
        -moz-border-radius: 50em;
        -webkit-border-radius: 50em;
    }

    img {
        max-width: 100%;
    }

    .chat-body {
        padding-bottom: 20px;
    }

    .chat li.left .chat-body {
        margin-left: 70px;
        background-color: #fff;
    }

    .chat li .chat-body {
        position: relative;
        font-size: 11px;
        padding: 10px 25px 10px 15px;
        border: 1px solid #f1f5fc;
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        -moz-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }

    .chat li .chat-body .header {
        padding-bottom: 5px;
        border-bottom: 1px solid #f1f5fc;
    }

    .chat li .chat-body p {
        margin: 0;
        font-size: 1.35rem;
    }

    .chat li.left .chat-body:before {
        position: absolute;
        top: 10px;
        left: -8px;
        display: inline-block;
        background: #fff;
        width: 16px;
        height: 16px;
        border-top: 1px solid #f1f5fc;
        border-left: 1px solid #f1f5fc;
        content: '';
        transform: rotate(-45deg);
        -webkit-transform: rotate(-45deg);
        -moz-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        -o-transform: rotate(-45deg);
    }

    .chat li.right .chat-body:before {
        position: absolute;
        top: 10px;
        right: -8px;
        display: inline-block;
        background: #fff;
        width: 16px;
        height: 16px;
        border-top: 1px solid #f1f5fc;
        border-right: 1px solid #f1f5fc;
        content: '';
        transform: rotate(45deg);
        -webkit-transform: rotate(45deg);
        -moz-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -o-transform: rotate(45deg);
    }

    .chat li {
        margin: 15px 0;
    }

    .chat-body {
        width: 350px;
        max-width: 350px;
    }

    .chat li.right .chat-body {
        float: right;
        margin-right: 50px;
        background-color: #fff;
        width: 350px;
        max-width: 350px;
    }

    .chat-box {
        padding: 30px 15px;
        border-top: 1px solid #eee;
        border-left: 1px solid #eee;
        transition: all .5s ease;
        -webkit-transition: all .5s ease;
        -moz-transition: all .5s ease;
        -ms-transition: all .5s ease;
        -o-transition: all .5s ease;
    }

    .primary-font {
        color: #3c8dbc;
    }

    a:hover,
    a:active,
    a:focus {
        text-decoration: none;
        outline: 0;
    }

    .container--chat--message {
        display: flex;
        height: calc(100vh - 81px);
    }

    .container--content {
        margin: 0;
        padding-top: 81px;
    }

    .container-message {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border-left: 2px solid;
    }
</style>
<div class="page--home" style="padding:0">
    <div class="container--chat--message">
        <div class="col-md-4">
            <div class=" row border-bottom padding-sm" style="height: 40px;">

            </div>

            <!-- =============================================================== -->
            <!-- member list -->
            <ul class="friend-list" style="padding: 0;">
                @foreach($list_room as $l_r)
                <li class="room__{{$l_r->id}}" style="background: aliceblue;padding-left: 10px;border-bottom-left-radius: 20px;border-top-left-radius: 20px;">
                    <a href="{{route('user.chat', $l_r->id_store)}}" class="clearfix">
                        <img style="object-fit: cover; border-radius: 50%" src="{{ asset('upload/store/avatars/' . $l_r->store->avatar) }}" alt="" class="img-circle">
                        <div class="friend-name">
                            <strong>{{$l_r->store->name}}</strong>
                        </div>
                        @if($l_r->new_message($l_r->id) == null)
                            <div class="last-message text-muted old">Bắt đầu cuộc trờ chuyện ngay</div>
                            <small class="time text-muted"></small>
                        @else
                            <div class="last-message text-muted old">{{$l_r->new_message($l_r->id)->message}}.</div>
                            <small class="time text-muted">{{$l_r->new_message($l_r->id)->created_at->diffForHumans()}}</small>
                        @endif
                    </a>
                </li>
                @endforeach
            </ul>
        </div>

        <!--=========================================================-->
        <!-- selected chat -->
        <div class="col-md-8 bg-white container-message">
            @if($id_store == 0)
            <div class="chat-message" style="justify-content: center">
                <ul class="chat container--messages" style="padding: 0;">
                    <li class="clearfix">
                        <div class="clearfix" style="font-size: 14px;display: flex;align-items: center;justify-content: center;">
                            <p style="text-align: center;max-width: 450px;">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales at.
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
            @else
            <div class="row border-bottom" style="height: 40px;">

            </div>
            <div class="chat-message">
                <ul class="chat container--messages container__messages__room__{{$room == null ? '0' : $room->id}}" style="padding: 0;">
                    @if($room == null)
                    <li class="clearfix">
                        <div class="clearfix" style="font-size: 14px;display: flex;align-items: center;justify-content: center;">
                            <p style="text-align: center;max-width: 500px;">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales at.
                            </p>
                        </div>
                    </li>
                    @else
                    @foreach($room->all_message as $r)
                    @if($r->type == 0)
                    <li class="right clearfix">
                        <span class="chat-img pull-right">
                            <img style="object-fit: contain;" src="{{ asset('upload/profile/avatar/' . Auth::user()->avatar) }}" alt="User Avatar">
                        </span>
                        <div class="chat-body clearfix" style="background-image: linear-gradient(-135deg, #f5f7fa 0%, #c3cfe2 100%);">
                            <div class="header">
                                <strong class="primary-font">{{Auth::user()->name}}</strong>
                                <small class="pull-right text-muted"><i class="fa fa-clock-o"></i> {{$r->created_at->diffForHumans()}}</small>
                            </div>
                            <p style="    padding-top: 10px;">
                                {{$r->message}}
                            </p>
                        </div>
                    </li>
                    @else
                    <li class="left clearfix">
                        <span class="chat-img pull-left">
                            <img style="object-fit: contain;" src="{{ asset('upload/store/avatars/' . $room->store->avatar) }}" alt="User Avatar">
                        </span>
                        <div class="chat-body clearfix" style="background-image: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
                            <div class="header">
                                <strong class="primary-font">{{$room->store->name}}</strong>
                                <small class="pull-right text-muted"><i class="fa fa-clock-o"></i> {{$r->created_at->diffForHumans()}}</small>
                            </div>
                            <p style="    padding-top: 10px;">
                                {{$r->message}}
                            </p>
                        </div>
                    </li>
                    @endif
                    @endforeach
                    @endif
                </ul>
            </div>
            <div class="chat-box bg-white">
                <div class="input-group">
                    <input class="form-control border no-shadow no-rounded message_send" style="font-size: 1.5rem;" placeholder="Type your message here">
                    <span class="input-group-btn">
                        <button class="btn btn-success no-rounded btn-submit-message" data-id="{{$id_store}}" data-room="{{$room == null ? 'false' : $room->id}}" data-type="0" style="font-size: 1.5rem;" type="button">Send</button>
                    </span>
                </div><!-- /input-group -->
            </div>
            @endif
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(function() {
        $(".heading-compose").click(function() {
            $(".side-two").css({
                "left": "0"
            });
        });

        $(".newMessage-back").click(function() {
            $(".side-two").css({
                "left": "-100%"
            });
        });
    })
</script>
@endsection