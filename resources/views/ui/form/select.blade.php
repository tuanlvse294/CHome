<div class="field {{$errors->has($name)?'error':''}}">

    <label for="{{$name}}">{{$label}}</label>

    <select class="ui fluid search selection dropdown" name="{{$name}}">
        <option value="">Chọn một tùy chọn</option>
        @foreach($options as $option)
            <option value="{{$option->id}}" {{($option->id==old($name))?'selected':''}}>{{$option->name}}</option>
        @endforeach
    </select>
</div>