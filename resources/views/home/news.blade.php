<div class="ui items segment">
    @foreach($offers as $offer)
        @include('offer.row_item',['item'=>$offer])
        <hr class="ui divider">
    @endforeach
    <div style="text-align: center">
        {{ $offers->appends(Request::except('page'))->links('vendor.pagination.default') }}
    </div>
</div>