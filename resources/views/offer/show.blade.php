<?php
$is_admin = (Auth::check() && (Auth::user()->has_role('admin') || Auth::user()->has_role('mod')));
?>
@extends($is_admin?'layouts.admin':'layouts.default')
@section('content')
    <div class="ui {{$is_admin?'fluid':''}} container">
        @if(!$is_admin)

            <div class="ui breadcrumb">
                <a class="section" href="/">Trang chủ</a>
                <i class="right angle icon divider"></i>
                <div class="active section">{{$title}}</div>
            </div>
        @endif
        <div class="ui huge header">{{$title}}</div>
        @include('offer.list2',['offers'=>$items])

    </div>

@endsection