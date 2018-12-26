<select class="ui compact selection fluid  dropdown">
    @foreach($districts as $district)
        <option value="{{$district->id}}">{{$district->name}}</option>
    @endforeach
</select>
