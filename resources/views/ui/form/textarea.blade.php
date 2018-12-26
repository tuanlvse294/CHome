<div class="field {{$errors->has($name)?'error':''}}">
<label for="{{$name}}">{{$label}}</label>
    <textarea name="{{$name}}" style="width: 100%">{!! old($name) !!}</textarea>
</div>