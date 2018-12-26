<div class="field {{$errors->has($name)?'error':''}}">

    <label for="{{$name}}">{{$label}}</label>

    <select class="ui fluid search selection dropdown" name="{{$name}}">
        <option value="">Select</option>
        @foreach($options as $key=>$option)
            <option value="{{$key}}" {{($key==old($name))?'selected':''}}>{{$option}}</option>
        @endforeach
    </select>
</div>