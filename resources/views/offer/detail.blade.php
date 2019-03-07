@extends('layouts.default')

@section('content')
    <div class="ui container">
        <div class="ui breadcrumb" style="margin-bottom: 10px">
            <a class="section" href="/">Trang chủ</a>
            <i class="right angle icon divider"></i>
            <a class="section" href="/?city={{$item->city->id}}">{{$item->city->name}}</a>
            <i class="right angle icon divider"></i>
            <a class="section"
               href="/?city={{$item->city->id}}&district={{$item->district->id}}">{{$item->district->name}}</a>
            <i class="right angle icon divider"></i>
            <div class="active section">{{$item->title}}</div>
        </div>
        <br><br>
        <div class="ui two column stackable grid ">
            <div class="column">
                <div class="image square">
                    <img src="/uploads/{{$item->get_icon()}}" style="width: 100%" class="offer_image"
                         id="main_image">
                </div>
                <div class="ui divider"></div>
                <div class="ui five column grid">
                    @foreach(json_decode($item->images) as $image)
                        <div class="column">
                            <img src="/uploads/{{$image}}" class="small_thumbnail">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="column">
                <h1>{{$item->title}} </h1>
                <div style="text-align: right">
                    @include('offer.like_button')
                </div>
                <h4>({{$item->views}} lượt xem)</h4>
                <h2 style="color: red">
                    {{$item->get_price_vnd()}}
                </h2>
            </div>
        </div>


        <div class="ui  segment">
            <h3 class="ui dividing header">Chi tiết</h3>
            {!! $item->content !!}
        </div>

        {{--<h1>Sản phẩm liên quan</h1>--}}

        {{--<div class="ui four column stackable grid">--}}
        {{--@foreach($related as $offer)--}}
        {{--<div class="column">--}}
        {{--@include('offer.card',['item'=>$offer])--}}
        {{--</div>--}}
        {{--@endforeach--}}
        {{--</div>--}}
    </div>
@endsection