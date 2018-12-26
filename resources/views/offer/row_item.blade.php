<div class="item ">
    <div class="image">
        <img src="/images/no-thumbnail.png">
    </div>
    <div class="content">
        <a class="header">{{$item->title}}</a>
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