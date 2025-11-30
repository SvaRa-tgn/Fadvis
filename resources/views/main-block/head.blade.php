<!doctype html>
<html class="no-js" lang="ru">

<head>
    <meta charset="utf-8">
    <title>FADVIS</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--font-->
    <link rel="preconnect" href="{{asset('https://fonts.googleapis.com')}}">
    <link rel="preconnect" href="{{asset('https://fonts.gstatic.com')}}" crossorigin>
    <link href="{{asset('https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap')}}"
          rel="stylesheet">

    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css?v=').time()}}">
    <link rel="stylesheet" href="{{asset('css/normalize.css?v=').time()}}">
    <link rel="stylesheet" href="{{asset('css/styles.min.css?v=').time()}}">
    <link rel="stylesheet" href="{{asset('css/header.min.css?v=').time()}}">
    <link rel="stylesheet" href="{{asset('css/main.min.css?v=').time()}}">
    <link rel="stylesheet" href="{{asset('css/page.min.css?v=').time()}}">
    <link rel="stylesheet" href="{{asset('css/footer.min.css?v=').time()}}">
    <link rel="stylesheet" href="{{asset('css/form.min.css?v=').time()}}">
    <link rel="stylesheet" href="{{asset('css/popup.min.css?v=').time()}}">

    @stack('styles')

    <script src="{{asset('js/jquery.min.js?v=').time()}}" defer></script>
    <script src="{{asset('js/main.js?v=').time()}}" defer></script>
    <script src="{{asset('js/request.js?v=').time()}}" defer></script>
    <script src="{{asset('js/request-order.js?v=').time()}}" defer></script>

    <meta name="theme-color" content="#fafafa">
</head>

@if(Route::currentRouteName() === 'main' ||
    Route::currentRouteName() === 'show.catalog' ||
    Route::currentRouteName() === 'show.category' ||
    Route::currentRouteName() === 'show.product' ||
    Route::currentRouteName() === 'show.price.form' ||
    Route::currentRouteName() === 'show.prothesis.form' )
    @include('main-block.header')
@else
    @include('main-block.admin-header')
@endif
