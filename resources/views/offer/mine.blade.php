@extends('layouts.default')
@section('content')
    <style>
        .some-padding {
            padding-right: 10px;
            padding-left: 10px;
        }
    </style>
    <div class="ui  some-padding container">
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
                <th>Lượt xem</th>
                <th>TC QC</th>
                <th>Thời hạn gói tin đặc biệt</th>
                <th>Thời hạn gói tin top</th>
                <th>Thời hạn gói tin nổi bật</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{$loop->index	+1}}</td>
                    <td style="text-align: center;width: 20%">
                        <img src="/uploads/{{$item->get_icon()}}" class="image_4_3">
                    </td>
                    <td style="width: 30%">
                        <b><a href="{{route('offers.show',[$item->id])}}">{{$item->title}}</a></b>
                    </td>
                    <td>{{str_replace(',', '.', number_format($item->price))."₫"}}</td>

                    <td>{{$item->views}}</td>
                    <td data-tooltip="Lượt tiếp cận qua QC" data-position="top center">{{$item->ads_reach}}</td>
                    <td>{{$item->premium_expire_status()}}</td>
                    <td>{{$item->top_expire_status()}}</td>
                    <td>{{$item->highlight_expire_status()}}</td>
                    <td>
                        <a href="{{route('offers.delete',[$item->id])}}" class="ui icon red button"><i
                                    class="low confirmed vision icon"></i> Ẩn tin</a>
                        <a href="{{route('offers.promote',[$item->id])}}"
                           class="ui icon confirmed green button"><i class="bullhorn icon"></i> Bán nhanh hơn</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection