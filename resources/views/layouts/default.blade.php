@extends('layouts.blank')
@section('body_content')
    <body style="background: #F4F4F4">
    @include('layouts.top_menu')
    @include('layouts.messages')
    @yield('content')
    @include('layouts.footer')
    </body>

@endsection

