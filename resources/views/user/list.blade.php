@extends('layouts.admin')
@section('content')

    <div class="ui fluid container">
        <div class="ui huge header">{{$title}}</div>
        @include('layouts.messages')

        <a href="{{route('users.export')}}" class="ui green button"><i class="download icon"></i> Download as CSV</a>
        <br>
        <br>
        <table class="ui celled table">
            <thead>
            <tr>
                <th>#ID</th>
                <th>Email</th>
                <th>Tên</th>
                <th>SĐT</th>
                <th>Quyền hạn</th>
                <th>Thời gian</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>
                        <b><a href="{{route('users.show',[$item->id])}}">{{$item->email}}</a></b>
                    </td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->phone}}</td>
                    <td>
                        {{$item->roles_str()}}
                    </td>
                    <td>{{$item->updated_at}}</td>
                    <td>
                        @if(isset($trash))
                            <a href="{{route('users.restore',[$item->id])}}"
                               class="ui icon confirmed green button"><i class="recycle icon"></i> Phục hồi</a>
                        <!-- <a href="{{route('users.force_delete',[$item->id])}}"
                                   class="ui icon red button"><i class="delete icon"></i> Xóa</a> -->
                        @else
                            @if(Auth::id()!=$item->id)
                                <a href="{{route('users.delete',[$item->id])}}"
                                   class="ui confirmed icon yellow button"><i class="low vision icon"></i> Ẩn</a>
                                <a href="{{route('users.edit_permission',[$item->id])}}"
                                   class="ui confirmed icon green button"><i class="lock icon"></i> Quyền hạn</a>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection