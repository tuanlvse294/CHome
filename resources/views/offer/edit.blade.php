@extends('layouts.default')

@section('content')
    <div class="ui container">
        <div class="ui breadcrumb">
            <a class="section" href="/">Trang chủ</a>
            <i class="right angle icon divider"></i>
            <a class="section" href="/manage/products">Rao vặt</a>
            <i class="right angle icon divider"></i>
            <div class="active section">Sửa</div>
        </div>


        <div class="ui grid" style="margin-top: 10px">
            <div class="two wide column">
            </div>
            <div class="twelve wide column">
                <div class="ui  segment">
                    <h3 class="ui dividing header">{{$title}}</h3>
                    @include('layouts.errors_block')
                    <form class="ui form" method="post" action="/offers{{isset($item)?'/'.$item->id:''}}"
                          enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{isset($item)?method_field('put'):method_field('post')}}
                        @include('ui.form.input',['name'=>'title','label'=>'Tiêu đề *','type'=>'text'])
                        @include('ui.form.files',['name'=>'image[]','label'=>'Hình ảnh *'])
                        @if(isset($item))
                            <div class="field">
                                <div class="ui five column grid">
                                    @foreach(array_filter(explode(';',$item->images)) as $image)
                                        <div class="column">
                                            <img src="/images/{{$image}}" style="margin: 4px;width: 100%">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @include('ui.form.select',['name'=>'city_id','label'=>'Tỉnh, thành phố *','options'=>\App\City::all()])
                        @include('ui.form.select',['name'=>'district_id','label'=>'Quận, huyện *','options'=>[]])
                        @include('ui.form.input',['name'=>'address','label'=>'Địa chỉ nhà *','type'=>'text'])
                        @include('ui.form.input',['name'=>'price','label'=>'Giá (VNĐ) *','type'=>'number','min'=>0])
                        @include('ui.form.input',['name'=>'area','label'=>'Diện tích (m2) *','type'=>'number','min'=>0])
                        @include('ui.form.ckeditor',['name'=>'content','label'=>'Nội dung chi tiết *'])
                        <button class="ui primary button" type="submit">Đăng</button>
                    </form>
                </div>
            </div>
        </div>
        <script>
            $(() => {
                $('select[name=city_id]').change(()=>{
                    $.get('/cities/' + event.currentTarget.value + '/districts', (res) => {
                        console.log(res);
                        $('select[name=district_id]').html(res);
                    });
                });
            });
        </script>
    </div>
@endsection