<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">

    <script src="{{ asset('js/app.js')}}" async></script>
    <script src="{{asset('custom/adminnav.js')}}"></script>
    
    {{-- Tiny MCE Editor --}}
    {{--<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>--}}
    <script src="https://cdn.tiny.cloud/1/ahqrzywhp6m8zsa7s17galk60h0wfw8vpmz31op7w1q4btmh/tinymce/5/tinymce.min.js"></script>
    <script>tinymce.init({selector:'textarea'});</script>
        <!-- Google Tag Manager -->
        <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-WZ9Z62Q');
    </script>
    <!-- End Google Tag Manager -->
</head>

<body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZ9Z62Q" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->