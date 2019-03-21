@extends('layouts.admin')

@section('content')
    <div class="ui fluid container">
        <div class="ui grid" >
            <div class="eight wide column">
                <div class="ui huge header">Đổi mật khẩu</div>
                @include('layouts.errors_block')
                <form class="ui form" method="post" action="{{route('password.save')}}">
                    {{csrf_field()}}
                    @include('ui.form.input',['name'=>'old_password','label'=>'Mật khẩu cũ ','type'=>'password'])
                    @include('ui.form.input',['name'=>'new_password','label'=>'Mật khẩu mới','type'=>'password'])
                    @include('ui.form.input',['name'=>'new_password_confirmation','label'=>'Xác nhận mật khẩu mới','type'=>'password'])
                    <button class="ui primary button" type="submit">Đổi</button>
                </form>
            </div>
        </div>

    </div>
@endsection