<?php
$is_admin = (Auth::check() && (Auth::user()->has_role('admin') || Auth::user()->has_role('mod')));
?>
@extends($is_admin?'layouts.admin':'layouts.default')
@section('content')
    <div class="ui {{$is_admin?'fluid':''}} container">
        @if(!$is_admin)
            <div class="ui breadcrumb">
                <a class="section" href="/">Trang chủ</a>
                <i class="right angle icon divider"></i>
                <a class="section" href="/?city={{$item->city->id}}">{{$item->city->name}}</a>
                <i class="right angle icon divider"></i>
                <a class="section"
                   href="/?city={{$item->city->id}}&district={{$item->district->id}}">{{$item->district->name}}</a>
                <i class="right angle icon divider"></i>
                <div class="active section">{{$title}}</div>
            </div>
            @include('ads.leaderboard')
            @include('offer.premiums')
        @else
            @include('layouts.messages')

        @endif


        <div class="ui huge header">{{$title}}</div>
        <div class="ui  modal">
            <img src="/apple-icon.png" id="modal_img" style="width: 100%;">
        </div>
        <div class="ui two column stackable grid ">
            <div class="column">
                <div class="ui segment">
                    <h3 class="ui dividing header">Tổng quan</h3>
                    <h3 style="color: red"><i class="money icon"></i> Giá: {{$item->get_price_vnd()}}</h3>

                    <b><p><i class="grey eye icon"></i> Lượt xem: {{$item->views}}</p>
                        <p><i class="grey marker icon"></i> Địa chỉ: {{$item->address}}</p>
                        <p><i class="grey map icon"></i> Diện tích: {{$item->area}} m<sup>2</sup> | <i
                                    class="grey warehouse icon"></i> Mặt tiền: {{$item->front}} m</p>
                        <p><i class="grey clock icon"></i> Ngày đăng: {{$item->updated_at->format('d/m/y')}}</p>
                    </b>
                    <h4>({{$item->views}} lượt xem)</h4>
                    <div style="float: right;margin-top: -43px">
                        @include('offer.like_button')
                    </div>
                </div>
                <div class="ui segment">
                    <h3 class="ui dividing header">Liên hệ</h3>
                    <b>
                        <p><i class="grey user icon"></i> Tên: {{$item->user->name}}</p>
                        <p><i class="grey mail icon"></i> Email: {{$item->user->email}}</p>
                        <p><i class="grey mobile icon"></i> SDT: {{$item->user->phone}}</p>
                    </b>
                </div>
                <div class="ui  segment">
                    <h3 class="ui dividing header">Chi tiết</h3>
                    {!! $item->content !!}
                </div>
            </div>
            <div class="column">
                <div class="ui segment">
                    <h3 class="ui dividing header">Hình ảnh (bấm vào để phóng to)</h3>
                    <div class="ui four column grid">
                        @foreach(json_decode($item->images) as $image)
                            <div class="column">
                                <img src="/uploads/{{$image}}" class="small_thumbnail">
                            </div>
                        @endforeach
                    </div>
                </div>
                @if($item->video_url!='')
                    <div class="ui segment">
                        <h3 class="ui dividing header">Video</h3>
                        <div class="ui embed" data-url="{{$item->video_url}}"></div>
                        <script>
                            $(() => {
                                $('.ui .embed').embed();
                            });
                        </script>
                    </div>
                @endif

            </div>

        </div>
        @if(!$is_admin)
            @include('offer.similars',['similars'=>$item->similars()])
        @endif
    </div>
@endsection