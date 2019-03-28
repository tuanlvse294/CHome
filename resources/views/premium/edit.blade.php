@extends('layouts.admin')

@section('content')
    <div class="ui fluid container">
        <div class="ui huge header">{{$title}}</div>

        <div class="ui grid" style="margin-top: 10px">
            <div class="two wide column">
            </div>
            <div class="twelve wide column">
                <div class="ui  segment">
                    @include('layouts.errors_block')
                    <form class="ui form" method="post"
                          action="{{isset($item)?route('premium.update',['pack'=>$item]):route('premium.store')}}">
                        {{csrf_field()}}
                        {{isset($item)?method_field('put'):method_field('post')}}
                        @include('ui.form.input',['name'=>'price','label'=>'Giá *','type'=>'number'])
                        @include('ui.form.input',['name'=>'days','label'=>'Thời hạn (ngày) *','type'=>'number'])
                        @include('ui.form.select2',['name'=>'type','label'=>'Kiểu giảm giá *','options'=>\App\PremiumPack::$TYPES])
                        @include('ui.form.textarea',['name'=>'info','label'=>'Thông tin *'])
                        <button class="ui primary button" type="submit">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection