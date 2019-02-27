<select class="ui compact selection fluid  dropdown">
    <option value="all" selected>Tất cả quận, huyện</option>
    @foreach($districts as $district)
        <option value="{{$district->id}}">{{$district->name}}</option>
    @endforeach
</select>
