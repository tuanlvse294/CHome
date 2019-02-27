@extends('layouts.default')
@section('content')
    <div class="ui container" style="margin-top: 40px">
        @include('layouts.search_box')
        @include('home.news')
    </div>


@endsection