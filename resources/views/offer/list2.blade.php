<div class="ui items segment">
    @if($offers->count() ==0)
        <p style="text-align: center"><b>Không tìm thấy kết quả phù hợp!!</b></p>
    @else
        @foreach($offers as $offer)
            @include('offer.row_item',['item'=>$offer])
            <hr class="ui divider">
        @endforeach
        <div style="text-align: center">
            {{ $offers->appends(Request::except('page'))->links('vendor.pagination.default') }}
        </div>
    @endif
</div>