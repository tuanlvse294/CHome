@extends('layouts.admin')
@section('content')

    <div class="ui fluid container">
        <div class="ui huge header">{{$title}}</div>
        <table class="ui celled table">
            <thead>
            <tr>
                <th>Tài khoản</th>
                <th>Số tiền</th>
                <th>Thông tin</th>
                <th>Thời gian tạo</th>
            </tr>
            </thead>
            <tbody>
            @foreach(\App\Transaction::all() as $item)
                <tr>
                    <td>
                        {{$item->user->email}}
                    </td>
                    <td>{{str_replace(',', '.', number_format($item->amount))."₫"}}</td>
                    <td>
                        {{$item->info}}
                    </td>
                    <td>
                        {{$item->updated_at}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection