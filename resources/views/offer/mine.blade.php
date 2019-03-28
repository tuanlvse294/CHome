@extends('layouts.default')
@section('content')

    <div class="ui container">
        <div class="ui breadcrumb">
            <a class="section" href="/">Trang chủ</a>
            <i class="right angle icon divider"></i>
            <div class="active section">{{$title}}</div>
        </div>
        <div class="ui huge header">{{$title}}</div>

        <table class="ui celled table">
            <thead>
            <tr>
                <th>#</th>
                <th>Hình ảnh</th>
                <th>Nội dung</th>
                <th>Giá</th>
                @if(Auth::check() && Auth::id()==$user->id)
                    <th>Thời hạn gói VIP</th>
                    <th>Hành động</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{$loop->index	+1}}</td>
                    <td style="text-align: center;width: 20%">
                        <img src="/uploads/{{$item->get_icon()}}" style="width:90%;">
                    </td>
                    <td style="width: 30%">
                        <b><a href="{{route('offers.show',[$item->id])}}">{{$item->title}}</a></b>
                    </td>
                    <td>{{money_format('%n', $item->price)}}</td>
                    @if(Auth::check() && Auth::id()==$item->user_id)

                        <td>{{$item->premium_expire}}</td>
                        <td>
                            @if(isset($trash) )
                                <a href="{{route('offers.restore',[$item->id])}}"
                                   class="ui icon green button"><i class="recycle icon"></i> Phục hồi</a>
                                {{--<a href="{{route('offers.force_delete',[$item->id])}}"--}}
                                {{--class="ui icon red button"><i class="delete icon"></i> Xóa</a>--}}
                            @else
                                <a href="{{route('offers.delete',[$item->id])}}" class="ui icon red button"><i
                                            class="low vision icon"></i> Ẩn tin</a>
                                <a href="{{route('offers.promote',[$item->id])}}"
                                   class="ui icon green button"><i class="bullhorn icon"></i> Bán nhanh hơn</a>

                            @endif
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection