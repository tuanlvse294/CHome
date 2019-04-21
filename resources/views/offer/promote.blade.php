@extends('layouts.default')
@section('content')

    <div class="ui container">
        <div class="ui breadcrumb">
            <a class="section" href="/">Trang chủ</a>
            <i class="right angle icon divider"></i>
            <a class="section" href="{{route('offers.show',['item'=>$offer->id])}}">{{$offer->title}}</a>
            <i class="right angle icon divider"></i>
            <div class="active section">{{$title}}</div>
        </div>
        <div class="ui huge header">{{$title}}</div>
        <div class='ui container codepen-margin'>
            <div class="ui three column grid">
                @foreach(\App\PremiumPack::all() as $pack)
                    <div class="column">
                        <div class="ui segments">
                            <div class="ui center aligned secondary segment">
                                <div class="ui statistic">
                                    <div class="value">
                                        {{money_format('%n', $pack->price)}}
                                    </div>
                                    <div class="label">
                                        / {{$pack->days}} ngày
                                    </div>
                                </div>
                            </div>
                            <div class="ui center aligned segment">
                                <p> {{$pack->type_str()}} </p>
                            </div>
                            <div class="ui center aligned segment">
                                <p> {{$pack->info}} </p>
                            </div>
                        </div>
                        <a class="ui green confirmed fluid button"
                           href="{{route('offers.promote.pick',['offer'=>$offer,'pack'=>$pack])}}">
                            Chọn mua
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection