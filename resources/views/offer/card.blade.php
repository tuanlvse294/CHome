<a class="ui card" href="/products/{{$item->id}}">
    <div class="image dimmable square" style="padding: 20px; background: white;display: table">
        <div class="ui blurring inverted dimmer transition hidden">
            <div class="content">
                <div class="center">
                    <div class="ui inverted green button add_to_cart_button" style="margin-bottom: 6px"
                         data-product_id="{{$item->id}}"
                    ><i class="cart plus icon"></i> Thêm vào giỏ
                    </div>
                    @if(Auth::check())
                        @if(Auth::user()->liked_products->contains($item))
                            <div class="ui inverted red button remove_from_wishlist_button"
                                 data-product_id="{{$item->id}}">
                                <i class="heart icon"></i> Bỏ thích
                            </div>
                        @else
                            <div class="ui inverted red button add_to_wishlist_button"
                                 data-product_id="{{$item->id}}">
                                <i class="heart icon"></i> Thích
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <img src="/images/{{explode(';',$item->image_urls)[0]}}" class="product_image">
    </div>
    @if($item->price > $item->sale_off)
        <div class="ui red top right attached label">Giảm giá</div>
    @endif
    @if($item->in_stock < 1 )
        <div class="ui red top left attached label">Hết hàng</div>
    @endif

    <div class="content" style="text-align: center">
        <h2 class="header" style="white-space: nowrap;overflow-x: hidden;text-overflow: ellipsis">{{$item->name}}</h2>
        <div class="meta">
            @if($item->price > $item->sale_off)
                <h2>
                    <del>{{$item->price}}$</del>
                    <span style="color: red">{{$item->sale_off}}$</span>
                </h2>
            @else
                <h2>
                    {{$item->price}}$
                </h2>
            @endif
        </div>
        <div class="ui star rating" data-rating="{{round($item->comments->avg('score'), 1)}}" data-max-rating="5"
             style="margin-top: 4px"></div>
    </div>
</a>