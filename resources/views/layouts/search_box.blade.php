<div class="ui segment">
    <form class="ui stackable grid">
        <div class="row">
            <div class="ten wide column ">
                <div class="ui fluid input">
                    <input class="fluid " type="text" name="query" placeholder="Bạn cần tìm kiếm gì?"
                           value="{{Request::get('query')}}">
                </div>
            </div>

            <div class="three wide column">
                <button type="submit" class="ui orange fluid button"><i class="search icon"></i>Tìm kiếm
                </button>
            </div>
            <div class="three wide column" style="vertical-align: center;padding-top: 8px">
                <h4 style="text-align: center"><a href="#" id="advanced-switch-open">Tìm kiếm nâng cao <i
                                class="down arrow icon"></i></a></h4>
            </div>
            <div class="two wide column" style="vertical-align: center;padding-top: 8px;display: none">
                <h4 style="text-align: center"><a href="#" id="advanced-switch-hide">Tìm kiếm nâng cao <i
                                class="up arrow icon"></i></a></h4>
            </div>
        </div>
        <div class="row" id="advanced-row" style="display: none">
            <div class="three wide column" >
                <select class="ui compact selection fluid dropdown" onchange="select_city()" name="city"
                        style="min-width: 400px">
                    <option value="all">Tỉnh, thành phố</option>
                    @foreach(\App\City::all() as $city)
                        <option value="{{$city->id}}" {{Request::input('city')==$city->id?'selected':''}}>{{$city->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="three wide column" style="padding-right: 0px">
                <select class="ui compact selection fluid dropdown" id="districts_select" name="district">
                    <option value="all">Quận, huyện</option>

                    @if(Request::input('city')!="all")
                        @foreach(\App\City::query()->findOrNew(Request::input('city'))->districts as $district)
                            <option value="{{$district->id}}" {{Request::input('district')==$district->id?'selected':''}}>{{$district->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="three wide column">
                <div class="ui fluid input">
                    <select class="ui compact selection fluid dropdown" name="area">
                        @foreach($areas as $index=>$area)
                            <option value="{{$index}}" {{Request::input('area')==$index?'selected':''}}>{{$area}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="two wide column">
                <div class="ui fluid input">
                    <select class="ui compact selection fluid dropdown" name="price">
                        @foreach($prices as $index=>$price)
                            <option value="{{$index}}" {{Request::input('price')==$index?'selected':''}}>{{$price}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="two wide column">
                <div class="ui fluid input">
                    <select class="ui compact selection fluid dropdown" name="front">
                        @foreach($fronts as $index=>$front)
                            <option value="{{$index}}" {{Request::input('front')==$index?'selected':''}}>{{$front}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="three wide column">
                <div class="ui fluid input">
                    <select class="ui compact selection fluid dropdown" name="sort">
                        @foreach($sorts as $index=>$sort)
                            <option value="{{$index}}" {{Request::input('sort')==$index?'selected':''}}>{{$sort}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>
    </form>
</div>

<script>
    function select_city() {
        $.get('/cities/' + event.currentTarget.value + '/districts', (res) => {
            console.log(res);
            $('#districts_select').html(res);
        });
    }

</script>
