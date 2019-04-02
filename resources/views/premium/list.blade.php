@extends('layouts.admin')
@section('content')

    <div class="ui fluid container">
        <div class="ui huge header">{{$title}}</div>
        <a class="ui primary button" href="{{route('premium.create')}}" style="margin-bottom: 10px"><i
                    class="plus icon"></i>Tạo gói tin đặc biệt mới</a>
        <table class="ui celled table">
            <thead>
            <tr>
                <th>Giá</th>
                <th>Số ngày</th>
                <th>Loại</th>
                <th>Thông tin</th>
                <th>Thời gian tạo</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>
                        {{money_format('%n', $item->price)}}
                    </td>
                    <td>
                        {{$item->days}}
                    </td>
                    <td>
                        {{\App\PremiumPack::$TYPES[$item->type]}}
                    </td>
                    <td>{{$item->info}}</td>
                    <td>
                        {{$item->updated_at}}
                    </td>
                    <td>
                        <div class="ui buttons">
                            <a href="{{route('premium.edit',['pack'=>$item])}}" class="ui icon blue button "><i
                                        class="pencil icon"></i> Sửa</a>
                            <a href="{{route('premium.delete',['pack'=>$item])}}"
                               class="ui icon green button confirmed"><i
                                        class="pencil icon"></i> Xóa</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection