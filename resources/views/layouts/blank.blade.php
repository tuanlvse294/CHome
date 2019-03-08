<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{isset($title)?$title.' - ':''}}CHome - Rao vặt bất động sản</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

@include('layouts.js_include')
<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-135879890-1"></script>
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
    </style>
</head>
<body>
@yield('body_content')
</body>
</html>

