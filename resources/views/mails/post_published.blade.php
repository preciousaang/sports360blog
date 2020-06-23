<!Doctype html>
<html style="height: 100%">
    <head>
        <title>New Post Published</title>
    </head>
    <body style="height: 100%;">
        <div style="height: 100%; width: 400px; border: 1px solid black; margin: 5px auto;">
            <div style="width: 100%; display: flex; align-content: center; align-items: center; height: 150px;">
                <img style="align-self: center; margin: auto" src="{{asset('images/logo.png')}}">
                
            </div>
            <div style="padding: 10px">
                <hr>
                <h2 align="center" color="white">New Post Alert</h2>
                <img style="width: 100%" src="{{$post->image}}" alt="{{$post->title}}">
                <h3 align="center">{{$post->title}}</h3>
                <a href="{{config('app.post_url')}}{{$post->slug}}" target="_blank" style="background-color: teal; color: white; margin: 0 auto; display: block; text-align: center; padding: 10px;font-weight: bold; text-decoration: none; font-size: 20px">Read</a>

                <br><hr>
                <a href="{{route('unsubscribe', $email)}}" target="_blank" style="text-align: center; display: block; color: #ccc;">Unsubscribe</a>
            </div>
            
        </div>
    </body>
</html>