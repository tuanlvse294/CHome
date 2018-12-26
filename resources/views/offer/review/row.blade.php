<div class="comment">
    <div class="avatar">
        <i class="big blue user icon"></i>
    </div>
    <div class="content">
        <a class="author">{{$item->user->name}}</a>
        <div class="metadata">
            <span class="date">{{$item->updated_at}}</span>
        </div>

        <div class="text">
            {{$item->content}}
        </div>
        <div class="ui star rating" data-rating="{{$item->score}}" data-max-rating="5"></div>

    </div>
</div>
<div class="ui divider"></div>