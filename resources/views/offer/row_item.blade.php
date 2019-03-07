<div class="item">
    <div class="image">
        <img src="/uploads/{{json_decode($item->images)[0]}}" style="max-height: 150px">
    </div>
    <div class="content">
        @include('offer.like_button')
        <a class="header" href="/offers/{{$item->id}}">{{$item->title}}</a>
        <div class="meta">
            <span>{{$item->address}}</span>
        </div>
        <div class="description">
            <p><i class=" grey money icon"></i> {{$item->price}}</p>
            <p><i class="grey eye icon"></i> {{$item->views}}</p>
        </div>
        <div class="extra">
            {{$item->updated_at}}
        </div>
    </div>
</div>