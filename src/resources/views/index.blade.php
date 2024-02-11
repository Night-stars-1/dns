<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="{{ config('sys.web.keywords') }}"/>
    <meta name="description" content="{{ config('sys.web.description') }}"/>
    <link href="/css/style.css" rel="stylesheet">
</head>
<body>
    <div id="app" data-web-name="{{ config('sys.web.name') }}"></div>
    @vite('resources/js/app.ts')
</body>
<script>
    window.webName = "{{ config('sys.web.name','二级域名分发') }}";
    window.htmlKefu = "{!! config('sys.html_kefu') !!}";
</script>
</html>
