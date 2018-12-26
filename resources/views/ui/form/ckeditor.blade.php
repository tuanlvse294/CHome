<div class="field {{$errors->has($name)?'error':''}}">
    <label for="{{$name}}">{{$label}}</label>
    <textarea class="ckeditor"  name="{{$name}}">{!! old($name) !!}</textarea>
</div>
