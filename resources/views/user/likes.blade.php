@extends('layouts.default')

@section('content')
    <div class="ui container">
        <div class="ui breadcrumb">
            <a class="section" href="/">Trang chủ</a>
            <i class="right angle icon divider"></i>
            <span class="active section">{{$title}}</span>
        </div>

        <div class="ui items segment">
            @foreach($offers as $offer)
                @include('offer.row_item',['item'=>$offer])
                <hr class="ui divider">
            @endforeach
            <div style="text-align: center">
                {{ $offers->appends(Request::except('page'))->links('vendor.pagination.default') }}
            </div>
        </div>

    </div>
@endsection