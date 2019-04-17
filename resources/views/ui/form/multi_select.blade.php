<div class="field {{$errors->has($name)?'error':''}}">

    <label for="{{$name}}">{{$label}}</label>

    <select class="ui fluid multiple search selection dropdown" name="{{$name}}" multiple="">
        <option value="">Select</option>
        @foreach($options as $key=>$option)
            <option {{($user->has_role($key))?'selected':''}}  value="{{$key}}">{{$option}}</option>
        @endforeach
    </select>
    <script>
        $('select')
            .dropdown()
        ;
    </script>
</div>