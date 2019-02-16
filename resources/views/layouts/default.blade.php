@extends('layouts.blank')
@section('body_content')
    @include('layouts.top_menu')
    @if(Session::has('error'))
        <div class="ui error message container">
            <div class="header">
                {{Session::get('error')}}
            </div>
        </div>
    @endif
    @if(Session::has('message'))
        <div class="ui green message container">
            <div class="header">
                {{Session::get('message')}}
            </div>
        </div>

    @endif
    @yield('content')
    @include('layouts.footer')
@endsection

