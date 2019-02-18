<h1 class="ui header">Tin mới đăng</h1>
<div class="ui items">
    @foreach($offers as $offer)
        @include('offer.row_item',['item'=>$offer])
    @endforeach
</div>
<div class="ui container" style="text-align: center">
    {{ $offers->links('vendor.pagination.default') }}
</div>
