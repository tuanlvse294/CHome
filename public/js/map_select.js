$(document).ready(function () {

    // Advanced usage
    $(".placepicker").each(function () {

        // find map-element
        var target = this;
        var $collapse = $(this).parents('.form-group').next('.collapse');
        var $map = $collapse.find('.placepicker-map');

        // init placepicker
        var placepicker = $(this).placepicker({
            map: $map.get(0)
        }).data('placepicker');

        // reload map after collapse in
        $collapse.on('show.bs.collapse', function () {

            window.setTimeout(function () {
                placepicker.resizeMap();
                placepicker.reloadMap();
                if (!$(target).prop('value')) {
                    placepicker.geoLocation();
                }

            }, 0);

        });

    });

});
