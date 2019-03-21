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
                <div class="column">
                    <div class="ui segments">
                        <div class="ui center aligned secondary segment">
                            <div class="ui statistic">
                                <div class="value">
                                    22.000
                                </div>
                                <div class="label">
                                    VND / ngày
                                </div>
                            </div>
                        </div>
                        <div class="ui center aligned segment">
                            <p> - Hiển thị tách biệt </p>
                        </div>
                        <div class="ui center aligned segment">
                            <p> - Trong 24h từ khi bắt đầu dịch vụ </p>
                        </div>
                    </div>
                    <a class="ui green fluid button" href="{{route('offers.promote.pick',['offer'=>$offer,'pack'=>'day'])}}">
                        Chọn mua
                    </a>
                </div>
                <div class="column">

                    <div class="ui raised segments">

                        <div class="ui center aligned orange secondary segment">

                            <div class="ui statistic">
                                <div class="value">
                                    120.000
                                </div>

                                <div class="label">
                                    VND / 7 ngày
                                </div>
                            </div>
                        </div>
                        <div class="ui center aligned segment">
                            <p> - Hiển thị tách biệt </p>
                        </div>
                        <div class="ui center aligned segment">
                            <p> - Trong 1 tuần từ khi bắt đầu dịch vụ </p>
                        </div>
                        <div class="ui top right attached red label" style="width: auto"> -20%</div>

                    </div>
                    <a class="ui orange fluid button" href="{{route('offers.promote.pick',['offer'=>$offer,'pack'=>'week'])}}">
                        Chọn mua
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection