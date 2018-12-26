<h1 class="ui header">Tin mới đăng</h1>
<div class="ui items" >
    @for($i=0;$i<16;$i++)
        @include('offer.row_item')
    @endfor
</div>