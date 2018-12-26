<div class="field {{$errors->has($name)?'error':''}}">
    <label for="{{$name}}">{{$label}}</label>
    <input name="{{$name}}" type="file">
    @if(isset($item[$name]))
        <input type="hidden" value="{{$item[$name]}}" name="{{$name}}_old">
        <label style="margin-top: 10px">{{$label}}'s old value</label>
        <img src="/images/{{$item[$name]}}" style="max-height: 300px;margin-top: 4px">
    @endif

</div>