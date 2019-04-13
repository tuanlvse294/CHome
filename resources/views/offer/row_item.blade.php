<div class="item">
    <div class="image">
        <img src="/uploads/{{json_decode($item->images)[0]}}"
             class="image_4_3">
    </div>
    <div class="content">
        <a class="header" href="/offers/{{$item->id}}">{{$item->title}}</a>
        <div class="description">
            <h3 style="color: red"><i class="money icon"></i> Giá: {{$item->get_price_vnd()}}</h3>
            <p><i class="grey eye icon"></i> Lượt xem: {{$item->views}}</p>
            <p><i class="grey marker icon"></i> Địa chỉ: {{$item->address}}</p>
            <p><i class="grey map icon"></i> Diện tích: {{$item->area}} m<sup>2</sup> | <i
                        class="grey warehouse icon"></i> Mặt tiền: {{$item->front}} m</p>
            <p><i class="grey clock icon"></i> Ngày đăng: {{$item->created_at->format('d/m/y')}}</p>
        </div>
        <div class="right floated" style="margin-top:-36px">
            @include('offer.like_button')
        </div>

    </div>
</div>