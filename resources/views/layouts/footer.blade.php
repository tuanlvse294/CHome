<div id="footer-padding"></div>
<div style="background: black;padding-top:10px;padding-bottom: 50px;" id="xfooter">
    <div class="ui container">
        <div class="ui inverted secondary menu stackable three column grid">
            <div class="column"></div>
            <div class="column">
                <p class="ui dividing header item"><strong>Copyright</strong></p>
                <p class="item"> C-Home © 2018. All Rights Reserved.</p>
            </div>
            {{--<div class="column">--}}
            {{--<p class="ui dividing header item"><strong>Contact</strong></p>--}}
            {{--<p class="item" >Email: {{Setting::get('email','not_set@gmail.com')}}</p>--}}
            {{--<p class="item" >Phone: {{Setting::get('phone','000000')}}</p>--}}
            {{--</div>--}}
            {{--<div class="column">--}}
            {{--<p class="ui  dividing header item"><strong>Liên kết</strong></p>--}}
            {{--@foreach(Setting::get('more_links',[]) as $label=>$link)--}}
            {{--<a class="item" href="{{$link}}">{{$label}}</a>--}}
            {{--@endforeach--}}
            {{--</div>--}}
        </div>
        <h1 style="color: white;text-align: center">
            <span style="border: solid 2px white;padding: 10px">C-Home.xyz</span></h1>
    </div>
</div>

<script>
    $(() => {
        footer_h = $('#xfooter').height();
        footer_bottom = $('#xfooter').offset().top + footer_h;
        doc_height = $(document).height();
        if (footer_bottom < doc_height) {
            $('#footer-padding').height(doc_height - footer_bottom - 40)
        }
    });
</script>