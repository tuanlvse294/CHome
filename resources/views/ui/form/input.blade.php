<div class="field {{$errors->has($name)?'error':''}}">
    <label for="{{$name}}">{{$label}}</label>
    <input name="{{$name}}" type="{{isset($type)?$type:'text'}}" value="{{isset($value)?$value:old($name)}}" step="any" >
</div>