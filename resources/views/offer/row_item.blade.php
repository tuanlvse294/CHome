<div class="item">
    <div class="image">
        <img src="/uploads/{{json_decode($item->images)[0]}}">
    </div>
    <div class="content">
        <a class="header" href="/offers/{{$item->id}}">{{$item->title}}</a>
        <div class="meta">
            <span>{{$item->address}}</span>
        </div>
        <div class="description">
            <p><i class="money icon"></i> {{$item->price}}</p>
        </div>
        <div class="extra">
            {{$item->updated_at}}
        </div>
    </div>
</div>