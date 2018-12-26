<tr>
    <td style="text-align: center">
        <img src="/images/{{explode(';',$item->image_urls)[0]}}" style="width:120px;">
    </td>
    <td>
        <h3><a href="/products/{{$item->id}}">{{$item->name}}</a></h3>
    </td>
    <td>{{$item->price}}$</td>
    <td>{{$item->sale_off}}$</td>
    <td>{{$item->in_stock}} đơn vị</td>
    <td>
        <div class="ui buttons">
            <a href="/products/{{$item->id}}/edit" class="ui icon green button"><i class="pencil icon"></i> Sửa</a>
            <a href="javascript:void(0);" onclick="ask_to_delete_product({{$item->id}})"
               class="ui icon yellow button"><i class="delete icon"></i> Xóa</a>
        </div>
    </td>
</tr>