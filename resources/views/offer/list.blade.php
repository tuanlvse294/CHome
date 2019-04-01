@extends('layouts.admin')
@section('content')

    <div class="ui fluid container">
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
                    <td>{{money_format('%n', $item->price)}}</td>
                    <td>{{$item->updated_at}}</td>
                    <td>
                        <div class="ui buttons">
                            @if(isset($trash) )
                                <a href="{{route('offers.restore',[$item->id])}}"
                                   class="ui icon green button"><i class="recycle icon"></i> Phục hồi</a>
                            @else
                                @if(isset($accept))
                                    <a href="{{route('offers.accept',[$item->id])}}"
                                       class="confirmed ui icon green button"><i
                                                class="check icon"></i> Duyệt</a>
                                @endif
                                <a href="{{route('offers.delete',[$item->id])}}"
                                   class="confirmed ui icon yellow button"><i
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