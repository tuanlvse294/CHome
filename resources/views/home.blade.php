@extends('layouts.default')
@section('content')
    <div class="ui container">
        @include('layouts.search_box')
        @include('offer.premiums')
        @include('offer.list2')
    </div>
@endsection