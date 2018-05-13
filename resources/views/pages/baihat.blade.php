<?php use App\User; ?>
<?php use App\Comments; ?>
<?php use App\Likecmt; ?>
@extends('pages.layouts.index')

@section('content')
<section class="s-content s-content--narrow s-content--no-padding-bottom">

        <article class="row format-audio">

            <div class="s-content__header col-full">
                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                    {{$err}}<br>
                    @endforeach()
                </div>
                @endif

                @if(session('thongbao'))
                <div class="alert-box alert-box--error" style="font-family: serif;">
                    <p> {{session('thongbao')}} </p>
                </div>                        
                @endif
                <h1 class="s-content__header-title">
                    {{ $baihat->ten }}
                </h1>
                <h3>
                    {{ $baihat->casi->ten }}
                </h3>
                <ul class="s-content__header-meta">
                    <li class="date">Ngày Tải lên: {{ $baihat->created_at }}</li>
                </ul>
            </div> <!-- end s-content__header -->
    
            <div class="s-content__media col-full">
                <div class="s-content__post-thumb">
                    <img src="upload/baihat/images/{{ $baihat->urlanh }}" 
                         srcset="upload/baihat/images/{{ $baihat->urlanh }} 2000w, 
                                upload/baihat/images/{{ $baihat->urlanh }} 1000w, 
                                upload/baihat/images/{{ $baihat->urlanh }} 500w" 
                         sizes="(max-width: 2000px) 100vw, 2000px" alt="" >

                    <div class="audio-wrap">
                        <audio autoplay="" width="100%" height="42" controls>
                            <source src="upload/baihat/nhacthuong/{{ $baihat->urlthuong }}" type="audio/ogg">
                        </audio>
                    </div>
                </div>
            </div> <!-- end s-content__media -->
            
            <a onclick="myFunction({{$baihat->id}})" href="/downloadBaiHat/{{$baihat->id}}/{{$baihat->urlthuong}}" class="btn btn-general btn-white" style="padding: 5px;"><i class="fa fa-download"></i> Download (128Kbps)</a>

            <a onclick="myFunction({{$baihat->id}})" href="/downloadBaiHatVip/{{$baihat->id}}/{{$baihat->urlvip}}" class="btn btn-general btn-white" style="padding: 5px;"><i class="fa fa-download"></i> Download (320Kbps,Lossless)</a>

            <div class="col-full s-content__main">

                <h5>Lời bài hát: {{ $baihat->ten }}</h5>

                <p class="lead" style="font-family: serif;">{!! $baihat->lyrics !!}</p>

            </div> <!-- end s-content__main -->

        </article>


        <!-- comments
        ================================================== -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12" style="float: none;">
                        <h1 class="page-header">Bình luận
                            <small>comment</small>
                        </h1>
                    </div>
                    
                    {{-- <div class="boxComment col-md-4"> --}}
                    <div class="contain-all-comment"> 
                        <?php $countComment = 0; ?>
                        @foreach($comments as $cms)
                            @if($countComment >= 5)
                                <?php break; ?>
                            @endif
                            @if($cms->parent_id == 0)
                                <?php $countComment += 1; ?>
                                <div class="comments{{$cms->id}}">
                                    <?php $user = User::find($cms->user_id); ?>
                                    <div style="margin-bottom: 13px">
                                        <img class="avatar-user" src="upload/user/{{$user->urlanh}}" width="30px" />
                                        <p style="margin-bottom: 0px"><b>{{$user->name}}</b>
                                            <span class="span{{$cms->id}}" style="margin-left: 10px">{{$cms->comment}}</span>
                                            <span class="edit-div{{$cms->id}}"></span>
                                        </p>

                                        <?php $countLikecmt = Likecmt::Where('comment_id', $cms->id)->count(); ?>
                                            <span class="countIcon{{$cms->id}}">{{$countLikecmt}}</span>
                                        {{-- Check login user --}}
                                        @if($user_id != 0)
                                            <span>
                                                <ul class="fbicon contain-icon">
                                                    <li>
                                                        <?php $isLikecmt = Likecmt::Where('user_id', $user_id)->Where('comment_id', $cms->id)->count(); ?>
                                                        @if($isLikecmt == 0)
                                                            <a class = "control{{$cms->id}}" onclick="dislike({{$cms->id}}, {{$user_id}})"><i class="fa fa-thumbs-o-up icon-like" aria-hidden="true"></i></a>
                                                        @else
                                                            <?php $control = Likecmt::Where('user_id', $user_id)->Where('comment_id', $cms->id)->first(); ?>
                                                            @if($control->control == 1)
                                                                <a class = "control{{$cms->id}}" onclick="dislike({{$cms->id}}, {{$user_id}})"><i class="fa fa-thumbs-up icon-like" aria-hidden="true"></i></a>
                                                            @elseif($control->control == 0)
                                                                <a class = "control{{$cms->id}}" onclick="dislike({{$cms->id}}, {{$user_id}})"><img class="angry" src="pages/images/happy.png" /></a>
                                                            @else
                                                                <a class = "control{{$cms->id}}" onclick="dislike({{$cms->id}}, {{$user_id}})"><img class="none" src="pages/images/wow.png" /></a>
                                                            @endif
                                                        @endif

                                                        <ul class="show-icon">
                                                            <li ><a class="heart" onclick="like_comment({{$cms->id}}, {{$user_id}}, 1)"><i class="fa fa-thumbs-up icon-like" aria-hidden="true"></i></a></li>
                                                            <li ><a class="angry" onclick="like_comment({{$cms->id}}, {{$user_id}}, -1)"><img class="angry" src="pages/images/wow.png" /></a></li>
                                                            <li><a  onclick="like_comment({{$cms->id}}, {{$user_id}}, 0)"><img class="none" src="pages/images/happy.png" /></a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </span>

                                            {{-- Delete user'comment --}}
                                            @if($user_id == $cms->user_id)
                                                <a class="action" onclick="removeComment({{$cms->id}}, {{$music_id}})">Delete </a>
                                            @endif

                                            {{-- Reply comment --}}
                                            <span class="reply-span{{$cms->id}}">
                                                <a class = "action reply{{$cms->id}}" onclick = "load_reply({{$cms->id}})" style="font-size: 12px">Reply </a>
                                            </span>

                                            {{-- Edit user'comment --}}
                                            @if($user_id == $cms->user_id)
                                                <span class = "removeEdit{{$cms->id}}">
                                                    <a class=" action edit{{$cms->id}}" onclick="edit({{$cms->id}})" style="font-size: 12px">Edit</a>
                                                </span>
                                            @endif
                                        @else
                                            <a class = "control{{$cms->id}}" onclick="confirmLogin()"><i class="fa fa-thumbs-o-up icon-like" aria-hidden="true"></i></a>
                                        @endif

                                        {{-- Show create_at --}}
                                        <span class="dt"><i><?php echo date('d-m-Y H:i:s', strtotime($cms->created_at)); ?></i></span>
                                        {{-- Check reply --}}
                                        <?php $isReply = Comments::Where('parent_id', $cms->id)->count(); ?>
                                        @if($isReply != 0)
                                            <div class = "isReply{{$cms->id}}" style = "color: blue">
                                                <span class="reply-hidden{{$cms->id}}">
                                                    <a class = "action reply{{$cms->id}}" onclick = "load_reply({{$cms->id}})"><i class="fa fa-reply" aria-hidden="true"></i></a>
                                                    <a class = "action reply{{$cms->id}}" onclick = "load_reply({{$cms->id}})"> {{$isReply}} Replies</a>
                                                </span>
                                            </div>
                                        @else
                                            <div class = "isReply{{$cms->id}}" style = "color: blue">
                                                <span class="reply-hidden{{$cms->id}}"></span>
                                            </div>
                                        @endif
                                        <div class = "loadReply loadMore{{$cms->id}}"></div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        <div class="newComment"></div>
                        <div class="load-more" style="text-align: center;">
                            <?php if($countComment >= 5){ ?>
                                <a class = "action more-comment" onclick = "load_more(1, {{$baihat->id}})">Xem thêm</a>
                            <?php } ?>
                        </div>
                        <div class="addComment input-group">
                            <div class="contain-input-comment">
                                <input type="text" class="form-control comment-input" placeholder="Add your comment" />
                            </div>
                            <div class="input-group-btn">
                                @if($user_id != 0)
                                    <button class="btn btn-success" type="submit" onclick="addComment({{$music_id}})">Send</button>
                                @else
                                    <button class="btn btn-success" type="submit" onclick="confirmLogin()">Send</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- </div> --}}
                </div>
            </div>
    </div>
    <br/>

    </section>
@endsection

@section('script')
    {{-- function js --}}
    <script type="text/javascript" src="{{ URL::asset('pages/js/comment.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('pages/js/likecmt.js') }}"></script>
@endsection

@section('script')
<script>
    function myFunction(id){
        var $tmp = Number($('.number'+ id).text()) + 1;
        $('.number' + id + ':first').html(" " + $tmp);
    }
</script>
@endsection