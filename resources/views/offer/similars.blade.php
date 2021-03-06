@if($similars->count()>0)
    <div class="ui segment" id="premiums_panel">
        <h3>Tin tương tự</h3>
        <div class="ui stackable six column grid">
            @foreach($similars as $item)
                <div class="column">
                    <img src="/uploads/{{json_decode($item->images)[0]}}"
                         style="width: 100% !important;height: 140px;object-fit: cover;">

                    <p class="max_2_lines"><b> <a
                                    href="{{route('offers.show',['offer'=>$item])}}">{{$item->title}}</a></b>
                    </p>
                    <h3 style="color: red;text-align: center;margin: 0px"
                        class="max_1_lines">{{$item->get_price_vnd()}}</h3>
                </div>

            @endforeach
        </div>
    </div>
@endif