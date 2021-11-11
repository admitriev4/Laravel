@include('template.header')

    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="wrapper">
    <div class="youtube-container">
        @foreach($urls as $url)
            <iframe id="player" type="text/html" width="640" height="360" src="{{$url}}" frameborder="0"></iframe>
        @endforeach
    </div>

</div>

</body>
</html>
@include('template.footer')
