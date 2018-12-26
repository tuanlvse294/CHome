@extends('layouts.blank')
@section('body_content')
    @include('layouts.top_menu')
    @yield('content')
    @include('layouts.footer')
@endsection

