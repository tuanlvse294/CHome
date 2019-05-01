@extends('layouts.admin')
@section('content')

    <div class="ui fluid container">
        <div class="ui huge header">{{$title}}</div>
        @include('layouts.messages')

        <table class="ui celled table">
            <thead>
            <tr>
                <th>#ID</th>
                <th>Người đăng</th>
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
                    <td>{{$item->id}}</td>
                    <td>
                        <a href="{{route('users.show',['user'=>$item->user])}}">{{$item->user_id}}</a>
                    </td>
                    <td style="text-align: center;width: 20%">
                        <img src="/uploads/{{$item->get_icon()}}" class="image_4_3">
                    </td>
                    <td style="width: 10%">
                        <b><a href="{{route('offers.show_hidden',[$item->id])}}">{{$item->title}}</a></b>
                    </td>
                    <td>{{money_format('%n', $item->price)}}</td>
                    <td>{{$item->updated_at}}</td>
                    <td>

                        @if($item->user->trashed() )

                        @elseif($item->trashed() )
                            <a href="{{route('offers.restore',[$item->id])}}"
                               class="ui confirmed icon green button"><i class="recycle icon"></i> Phục hồi</a>
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
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection