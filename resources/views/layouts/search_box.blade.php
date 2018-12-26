<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="seven wide column ">
                <div class="ui fluid input">
                    <input class="fluid " type="text" placeholder="Bạn cần tìm kiếm gì?">
                </div>
            </div>
            <div class="three wide column" style="padding: 0px">
                <select class="ui compact selection fluid dropdown" onchange="select_city()"
                        style="min-width: 400px">
                    <option value="-1">Tất cả tỉnh, thành phố</option>
                    @foreach(\App\City::all() as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="three wide column" style="padding-right: 0px">
                <select class="ui compact selection fluid dropdown" id="districts_select">
                    <option value="all">Tất cả quận, huyện</option>
                </select>
            </div>
            <div class="three wide column">
                <div class="ui yellow fluid button"><i class="search icon"></i>Tìm kiếm</div>
            </div>
        </div>
    </div>
</div>

<script>
    function select_city() {
        $.get('/cities/' + event.currentTarget.value + '/districts', (res) => {
            console.log(res);
            $('#districts_select').html(res);
        });
    }

</script>
