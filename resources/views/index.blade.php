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
                <!-- Scripts -->
          <script>
            window.Laravel = {!! json_encode([
              'csrfToken' => csrf_token(),
            ]) !!};
          </script>
    </head>
    <body>



    <div id="app">
        <app-component></app-component>
    </div>
    @if(config('app.debug'))
    <script src="{{asset('js/app.js')}}"></script>
    @else
    <script src="{{secure_asset('js/app.js')}}"></script>
    @endif

    </body>
</html>
