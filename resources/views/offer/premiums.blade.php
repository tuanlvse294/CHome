<div class="ui segment">
    <h3>Tin đặc biệt</h3>
    <div class="ui stackable six column grid">
        @foreach($premiums as $item)
            <div class="column">
                <img src="/uploads/{{json_decode($item->images)[0]}}"
                     style="width: 100% !important;height: 140px;object-fit: cover;">

                <p class="max_2_lines"><b> <a href="/offers/{{$item->id}}">{{$item->title}}</a></b></p>
                <h3 style="color: red;text-align: center;margin: 0px"
                    class="max_1_lines">{{$item->get_price_vnd()}}</h3>
            </div>

        @endforeach
    </div>
</div>
<style>
    .max_2_lines {
        display: -webkit-box;
        overflow: hidden;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .max_1_lines {
        display: -webkit-box;
        overflow: hidden;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }
</style>