@extends('layouts.admin')

@section('content')
    <div class="ui fluid container">
        @include('layouts.messages')
        <div class="ui huge header">{{$title}}</div>
        @include('layouts.errors_block')
        <form class="ui form" method="post">
            {{csrf_field()}}
            @include('ui.form.multi_select',['name'=>'roles[]','label'=>'Quyền hạn','options'=>\App\User::ROLES])
            <button class="ui primary button" type="submit">Lưu</button>
        </form>
    </div>

@endsection