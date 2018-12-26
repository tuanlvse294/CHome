<div class="field {{$errors->has($name)?'error':''}}">
    <div class="ui checkbox">
        <input type="checkbox" name="{{$name}}" {{ old($name) ? 'checked' : '' }} >
        <label for="{{$name}}">{{$label}}</label>
    </div>
</div>