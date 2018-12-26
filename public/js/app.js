$(document).ready(function () {


});

$(function () {
    $('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]'
    });

    main_table = $("#main_table");
    main_table.DataTable();
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
    });
    setTimeout(() => {
        $('.auto_opened').click();

    }, 100);

});

function confirm_link(url) {
    bootbox.confirm("Bạn chắc chắn chứ?", function (result) {
        if (result) {
            location.href = url;
        }
    });
}


function delete_selected(url) {
    bootbox.confirm("Bạn chắc chắn chứ?", function (result) {
        if (result) {
            $('#main_list_form').submit();
        }
    });
}