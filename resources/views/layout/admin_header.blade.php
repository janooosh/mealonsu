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
</head>

<body>