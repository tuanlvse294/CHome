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
            <div class="ui grid">
                <div class="five wide column">
                    <div class="ui raised segments">
                        <div class="ui center aligned secondary segment">
                            <div class="ui statistic">
                                <div class="value">
                                    $50
                                </div>
                                <div class="label">
                                    per month
                                </div>
                            </div>
                        </div>
                        <div class="ui center aligned segment">
                            <p> - Premium Feature One </p>
                        </div>
                        <div class="ui center aligned segment">
                            <p> - Another great feature </p>
                        </div>
                    </div>
                    <div class="ui green fluid button">
                        Select
                    </div>
                </div>
                <div class="five wide column">
                    <div class="ui raised segments">
                        <div class="ui center aligned secondary segment">
                            <div class="ui statistic">
                                <div class="value">
                                    $20
                                </div>
                                <div class="label">
                                    per month
                                </div>
                            </div>
                        </div>
                        <div class="ui center aligned segment">
                            <p> - A basic feature </p>
                        </div>
                        <div class="ui center aligned segment">
                            <p> - Look. No additional CSS or anything </p>
                        </div>
                    </div>
                    <div class="ui green fluid button">
                        Select
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection