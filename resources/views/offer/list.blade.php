@extends('layouts.default')
@section('content')

    <div class="ui container">
        <div class="ui breadcrumb">
            <a class="section" href="/">Trang chủ</a>
            <i class="right angle icon divider"></i>
            <a class="section" href="/manage">Quản lý</a>
            <i class="right angle icon divider"></i>
            <div class="active section">{{$title}}</div>
        </div>
        <div class="ui huge header">Sản phẩm</div>
        <a class="ui primary button" href="/products/create" style="margin-bottom: 10px"><i class="plus icon"></i>Thêm sản phẩm mới</a>

        <table class="ui celled table" >
            <thead>
            <tr>
                <th>Hình ảnh</th>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Giảm giá</th>
                <th>Số lượng</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                @include('product.table_row',['item'=>$item])
            @endforeach
            </tbody>
        </table>
    </div>

@endsection