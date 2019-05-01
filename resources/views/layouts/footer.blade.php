<div id="footer-padding"></div>
<div style="background: black;padding-top:10px;padding-bottom: 50px;" id="xfooter">
    <div class="ui container">
        <div class="ui inverted secondary menu stackable three column grid">
            <div class="column">
                <p class="ui dividing header item"><strong>Contact</strong></p>
                <p class="item">Email: quanghnse04435@fpt.edu.vn</p>
                <p class="item">Hotline: 0963.501.365 - 0975.110.096</p>
            </div>
            <div class="column">
                <p class="ui dividing header item"><strong>Copyright</strong></p>
                <p class="item"> © Copyright 2019 Chome Inc. </p>
                <p class="item">All Rights Reserved</p>
            </div>
            <div class="column">
                <p class="item" >Xin chân thành cám ơn Quý khách đã quan tâm đến dự án CHOME.</p>
                <p class="item" >CHOME.XYZ – MUA BÁN NHÀ ĐẤT</p>
                <p class="item" >CÔNG TY TNHH ĐTQD </p>
            </div>
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