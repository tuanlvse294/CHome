@if(Auth::check())
    @if($item->likers->contains(Auth::user()))
        <div class="ui basic compact orange icon button unlike_button"
             data-offer_id="{{$item->id}}"><i class="star icon"></i></div>
    @else
        <div class="ui basic compact grey icon button like_button"
             data-offer_id="{{$item->id}}"><i class="star icon"></i></div>
    @endif
@endif

<script>
    $(() => {
        $('.like_button').click(function (e) {
            e.preventDefault();
            $.get('/offers/' + $(this).attr('data-offer_id') + '/like', function (result) {
                $(e.currentTarget).replaceWith(result);
            });
        });
        $('.unlike_button').click(function (e) {
            e.preventDefault();
            $.get('/offers/' + $(this).attr('data-offer_id') + '/unlike', function (result) {
                $(e.currentTarget).replaceWith(result);
            });
        });
    })
</script>