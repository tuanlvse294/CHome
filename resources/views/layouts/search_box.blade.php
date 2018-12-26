<div class="ui grid ">
    <div class="computer only row">
        <div class="ui container">
            <div class="ui action fluid input">
                <input type="text" placeholder="Bạn cần tìm kiếm gì?">
                <div style="min-width: 200px">
                    <select class="ui compact selection fluid dropdown" onchange="select_city()"
                            style="min-width: 400px">
                        <option value="-1">Tất cả tỉnh, thành phố</option>
                        @foreach(\App\City::all() as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div style="min-width: 200px">
                    <select class="ui compact selection fluid dropdown" id="districts_select">
                        <option value="all">Tất cả quận, huyện</option>
                    </select>
                </div>
                <div class="ui yellow button"><i class="search icon"></i>Tìm kiếm</div>
            </div>
        </div>
    </div>
    <div class="tablet mobile only row">
        tablet
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
