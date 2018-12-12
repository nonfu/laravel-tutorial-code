<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel分页组件</title>

    <link href="{{ asset('css/app.css')  }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <pagination-component page-type="posts"></pagination-component>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>