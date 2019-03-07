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
                <th>Email</th>
                <th>Thời gian</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{$loop->index	+1}}</td>
                    <td style="width: 40%">
                        <b><a href="{{route('users.show',[$item->id])}}">{{$item->email}}</a></b>
                    </td>
                    <td>{{$item->updated_at}}</td>
                    <td>
                        <div class="ui buttons">
                            @if(isset($trash))
                                <a href="{{route('users.restore',[$item->id])}}"
                                   class="ui icon green button"><i class="recycle icon"></i> Phục hồi</a>
                                <a href="{{route('users.force_delete',[$item->id])}}"
                                   class="ui icon red button"><i class="delete icon"></i> Xóa</a>
                            @else
                                <a href="{{route('users.delete',[$item->id])}}"
                                   class="ui icon yellow button"><i class="trash icon"></i> Xóa</a>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection