<!Doctype html>
<html lang="en-US">
    <head>
        <title>Bet Pro 360 Blog</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
        <link rel="icon" @if(config('app.debug')) href="{{asset('images/logo.png')}}" @else href="{{secure_asset('images/logo.png')}}" @endif>
        <style type="text/css">

        a.gflag {vertical-align:middle;font-size:16px;padding:1px 0;background-repeat:no-repeat;background-image:url(//gtranslate.net/flags/16.png);}
        a.gflag img {border:0;}
        a.gflag:hover {background-image:url(//gtranslate.net/flags/16a.png);}
        #goog-gt-tt {display:none !important;}
        .goog-te-banner-frame {display:none !important;}
        .goog-te-menu-value:hover {text-decoration:none !important;}
        body {top:0 !important;}
        #google_translate_element2 {display:none!important;}

        </style>
        <meta name="csrf-token" content="{{ csrf_token() }}">
                <!-- Scripts -->
          <script>
            window.Laravel = {!! json_encode([
              'csrfToken' => csrf_token(),
            ]) !!};
          </script>          
    </head>
    <body>
    <script type="text/javascript">
    function googleTranslateElementInit2() {new google.translate.TranslateElement({pageLanguage: 'en',autoDisplay: false}, 'google_translate_element2');}
    </script><script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>


    <script type="text/javascript">
    /* <![CDATA[ */
    eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('6 7(a,b){n{4(2.9){3 c=2.9("o");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s(\'t\'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a==\'\')v;3 b=a.w(\'|\')[1];3 c;3 d=2.x(\'y\');z(3 i=0;i<d.5;i++)4(d[i].A==\'B-C-D\')c=d[i];4(2.j(\'k\')==E||2.j(\'k\').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,\'m\');7(c,\'m\')}}',43,43,'||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element2|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500'.split('|'),0,{}))
    /* ]]> */
    </script>
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
