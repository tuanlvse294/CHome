<h1 class="ui header">Tin mới đăng</h1>
<div class="ui items">
    @foreach(\App\Offer::all() as $offer)
        @include('offer.row_item',['item'=>$offer])
    @endforeach
</div>