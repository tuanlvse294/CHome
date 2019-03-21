@extends('layouts.default')
@section('content')
    <div class="ui container">
        @include('layouts.search_box')
        @include('ads.leaderboard')

        @include('offer.premiums')
        <div class="ui stackable grid">
            <div class="thirteen wide column">
                @include('offer.list2')
            </div>
            <div class="three wide column">
                @include('ads.side')
            </div>
        </div>
    </div>
@endsection