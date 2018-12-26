@extends('layouts.default')

@section('content')
    <div class="ui container">
        <div class="ui breadcrumb" style="margin-bottom: 10px">
            <a class="section" href="/">Trang chủ</a>
            <i class="right angle icon divider"></i>
            <a class="section">{{$item->city->name}}</a>
            <i class="right angle icon divider"></i>
            <a class="section">{{$item->district->name}}</a>
            <i class="right angle icon divider"></i>
            <div class="active section">{{$item->title}}</div>
        </div>
        <br><br>
        <div class="ui two column stackable grid ">
            <div class="column">
                <div class="image square">
                    <img src="/uploads/{{json_decode($item->images)[0]}}" style="width: 100%" class="product_image"
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
                <h1>{{$item->title}}</h1>
                <p>({{$item->views}} đánh giá)</p>
                <h2>
                    {{$item->price}}$
                </h2>
                <div class="ui labeled action input">
                    @if(Auth::check())
                        @if(Auth::user()->liked_products->contains($item))
                            <div class="ui red button remove_from_wishlist_button"
                                 data-product_id="{{$item->id}}">
                                <i class="heart icon"></i> Bỏ thích
                            </div>
                        @else
                            <div class="ui red button add_to_wishlist_button"
                                 data-product_id="{{$item->id}}">
                                <i class="heart icon"></i> Thích
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>


        <div class="ui  segment">
            <h3 class="ui dividing header">Chi tiết</h3>
            {!! $item->content !!}
        </div>

        {{--<h1>Sản phẩm liên quan</h1>--}}

        {{--<div class="ui four column stackable grid">--}}
        {{--@foreach($related as $product)--}}
        {{--<div class="column">--}}
        {{--@include('product.card',['item'=>$product])--}}
        {{--</div>--}}
        {{--@endforeach--}}
        {{--</div>--}}
    </div>
@endsection