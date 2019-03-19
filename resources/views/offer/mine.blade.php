@extends('layouts.default')
@section('content')

    <div class="ui container">
        <div class="ui huge header">{{$title}}</div>

        <table class="ui celled table">
            <thead>
            <tr>
                <th>#</th>
                <th>Hình ảnh</th>
                <th>Nội dung</th>
                <th>Giá</th>
                <th>Thời gian</th>
                <th>Hành động</th>
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
                    <td>{{$item->price}} VND</td>
                    <td>{{$item->updated_at}}</td>
                    <td>
                        <div class="ui buttons">
                            @if(isset($trash) )
                                <a href="{{route('offers.restore',[$item->id])}}"
                                   class="ui icon green button"><i class="recycle icon"></i> Phục hồi</a>
                            <!-- <a href="{{route('offers.force_delete',[$item->id])}}"
                                   class="ui icon red button"><i class="delete icon"></i> Xóa</a> -->
                            @else
                                <a href="{{route('offers.delete',[$item->id])}}" class="ui icon yellow button"><i
                                            class="low vision icon"></i> Ẩn</a>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection