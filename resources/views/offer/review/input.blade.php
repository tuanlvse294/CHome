<h2>Đánh giá của bạn</h2>
<form class="ui form" action="/products/{{$item->id}}/save_review" method="post">
    @csrf
    <div class="field">
        <label for="score">Đánh giá</label>
        <div class="ui star rating input_rating" data-rating="{{old('score',3)}}" data-max-rating="5">
        </div>
        <input type="hidden" name="score" id="input_rating" value="{{old('score',3)}}">
    </div>
    @include('ui.form.textarea',['name'=>'content','label'=>'Review content'])
    <button class="ui primary button">Lưu đánh giá</button>
</form>
