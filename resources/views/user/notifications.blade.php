@extends('layouts.default')

@section('content')
    <div class="ui container">
        <div class="ui breadcrumb">
            <a class="section" href="/">Trang chủ</a>
            <i class="right angle icon divider"></i>
            <span class="active section">{{$title}}</span>
        </div>
        <div class="ui huge header">{{$title}}</div>

        <div class="ui items segment">
            @foreach($notifications as $notification)
                <a href="{{route('users.show_notification',['notification'=>$notification])}}"
                   @if(!$notification->seen)
                   style="color: red !important;"
                        @endif
                ><i
                            class="newspaper icon"></i>
                    {{$notification->title}}</a>
                <hr class="ui divider">
            @endforeach
            <div style="text-align: center">
                {{ $notifications->appends(Request::except('page'))->links('vendor.pagination.default') }}
            </div>
        </div>

    </div>
@endsection