<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{isset($title)?$title.' - ':''}}CHome - Rao vặt bất động sản</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

@include('layouts.js_include')
<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-135879890-1"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <script src="/bower_components/moment/min/moment.min.js"></script>
    <script src="/bower_components/semantic-ui-daterangepicker-master/daterangepicker.js"></script>
    <link rel="stylesheet" href="/bower_components/semantic-ui-daterangepicker-master/daterangepicker.css"/>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-135879890-1');
    </script>

    <link href="/css/semantic.min.css" rel="stylesheet">
    <link href="/css/app.css?t={{rand()}}" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

    <link rel="stylesheet" type="text/css" href="/bower_components/slick-carousel/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="/bower_components/slick-carousel/slick/slick-theme.css"/>

    <style>
        .slick-prev:before,
        .slick-next:before {
            color: darkgray;
        }

        #DataTables_Table_0_length {
            margin-bottom: 20px;
        }

        .blinking {
            animation: blinkingText 0.8s infinite;
        }

        @keyframes blinkingText {
            0% {
                color: white;
            }
            49% {
                color: white;
            }
            50% {
                color: transparent;
            }
            99% {
                color: transparent;
            }
            100% {
                color: white;
            }
        }

        .max_2_lines {
            display: -webkit-box;
            overflow: hidden;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .max_1_lines {
            display: -webkit-box;
            overflow: hidden;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
        }

        .image_4_3 {
            width: 90%;
        }
    </style>
</head>
@yield('body_content')
</html>

