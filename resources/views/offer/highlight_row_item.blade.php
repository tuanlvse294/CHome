<div class="item" style="background:#FDF6EC;padding: 10px">

    <div class="image">
        <span class="ui red left ribbon label">Hot * *</span>
        <img src="/uploads/{{json_decode($item->images)[0]}}"
             class="image_4_3">
    </div>
    <div class="content">
        @if($item->has_ads())
            <a class="header" href="{{route('offers.show',['offer'=>$item,'click'=>'from_ads'])}}">{{$item->title}}</a>
        @else
            <a class="header" href="{{route('offers.show',['offer'=>$item])}}">{{$item->title}}</a>
        @endif
        <div class="description">
            <h3 style="color: red"><i class="money icon"></i> Giá: {{$item->get_price_vnd()}}</h3>
            <b><p><i class="grey eye icon"></i> Lượt xem: {{$item->views}}</p>
                <p><i class="grey marker icon"></i> Địa chỉ: {{$item->address}}</p>
                <p><i class="grey map icon"></i> Diện tích: {{$item->area}} m<sup>2</sup> | <i
                            class="grey warehouse icon"></i> Mặt tiền: {{$item->front}} m</p>
                <p><i class="grey clock icon"></i> Ngày đăng: {{$item->created_at->format('d/m/y')}}</p>
            </b>
        </div>
        <div class="right floated" style="margin-top:-36px">
            @include('offer.like_button')
        </div>
    </div>

</div>