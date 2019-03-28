<!-- Scripts -->
<script src="/js/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/js/semantic.min.js" defer></script>
<script src="/ckeditor/ckeditor.js"></script>
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<script type="text/javascript" src="/bower_components/slick-carousel/slick/slick.js"></script>


<script>
    $(window).on('load', function () {

        $('.small_thumbnail').on('click', function (e) {
            $('#modal_img').attr('src', e.target.src);
            $('.ui.modal')
                .modal('show')
            ;
        });

    });
    $(function () {
        $('.ui.dropdown').dropdown({
            on: 'hover'
        });
        $('.ui.menu a.item')
            .on('click', function () {
                $(this)
                    .addClass('active')
                    .siblings()
                    .removeClass('active')
                ;
            })
        ;

        $('.special.card .image').dimmer({
            on: 'hover'
        });


        $('table').DataTable({"pageLength": 50});
        $('.dataTables_filter > label').attr('class', 'ui input');
        $('select[name="DataTables_Table_0_length"]').attr('class', 'ui dropdown');
        $('select.dropdown')
            .dropdown()
        ;
        $("#advanced-switch-open").on('click', function () {
            $("#advanced-row").show(1);
            $("#advanced-switch-open").parent().parent().hide(1);
            $("#advanced-switch-hide").parent().parent().show(1);
        });
        $("#advanced-switch-hide").on('click', function () {
            $("#advanced-row").hide(1);
            $("#advanced-switch-hide").parent().parent().hide(1);
            $("#advanced-switch-open").parent().parent().show(1);
        });

        function update_premiums() {
            $.get('/premiums', (res) => {
                $("#premiums_panel").replaceWith(res);
            });
        }

        $(() => {
            setInterval(update_premiums, 10000);
        });

        $('.comfirmed').on('click', (e) => {
            e.preventDefault();
            alert('fuck');
        });
    });


</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
    (function () {
        var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/5c81e323101df77a8be18104/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>
<!--End of Tawk.to Script-->