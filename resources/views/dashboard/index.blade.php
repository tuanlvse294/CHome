@extends('layouts.default')
@section('content')
    <style>
        .dash_seg {

        }
    </style>
    <div class="ui container">
        <div class="ui breadcrumb">
            <a class="section" href="/">Trang chủ</a>
            <i class="right angle icon divider"></i>
            <div class="active section">{{$title}}</div>
        </div>
        <div class="ui huge header">{{$title}}</div>
        <div class="ui stackable four column grid ">
            <div class="column center aligned">
                <div class="ui red segment">
                    <div class="ui statistic">
                        <div class="value">
                            {{\App\User::query()->count()}}
                        </div>
                        <div class="label">
                            <i class="user icon"></i>User

                        </div>
                    </div>

                </div>
            </div>
            <div class="column center aligned">
                <div class="ui blue segment">
                    <div class="ui statistic">
                        <div class="value">
                            {{\App\Offer::query()->count()}}
                        </div>
                        <div class="label">
                            <i class="user building"></i>Offers
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>


@endsection