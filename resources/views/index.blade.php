<!Doctype html>
<html>
    <head>
        <title>Bet Pro 360 Blog</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
        <link rel="icon" @if(config('app.debug')) href="{{asset('images/logo.png')}}" @else href="{{secure_asset('images/logo.png')}}" @endif>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v7.0&appId=1018801445144895&autoLogAppEvents=1" nonce="0ymS2L93"></script>
    <div id="app">
        <app-component></app-component>
    </div>
    @if(config('app.debug'))
    <script src="{{asset('js/app.js')}}"></script>
    @else
    <script src="{{secure_asset('js/app.js')}}"></script>
    @endif
    <div id="fb-root"></div>

    </body>
</html>
