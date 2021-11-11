<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/styles.css" />
    <link rel="stylesheet" type="text/css" href="/template-styles.css" />
    <title>@if (!empty($title))
            {{$title}}
        @else
            Laravel Dmitriev
        @endif</title>
</head>
<body>
<div class="wrapper">
<div class="header">
        {{--<div class="logo"></div>--}}
        <div class="menu">
            @if (!empty(Auth::user()))
                <a href="/users/" class="btn">Список пользователей</a>
                <a href="/user/show/update/" class="btn">Изменить данные пользователя</a>
                <a href="/user/show/update_pass/" class="btn">Изменить пароль пользователя</a>
                <a href="/user/show/delete/" class="btn">Удалить пользователя</a>
                <a href="/user/only-old/" class="btn">Страница для взрослых</a>
                <a href="/youtube/" class="btn">Ютуб</a>

                @else
                <a href="/" class="btn">Главная</a>
                <a href="/registration/" class="btn">Регистрация</a>
            @endif

            </div>
        <div class="user-info">
            @if (!empty(Auth::user()))
                <span>{{Auth::user()->name}}
                {{Auth::user()->last_name}} </span>
               <span>{{Auth::user()->email}}</span>
                <a href="/logout/" class="btn">Выйти</a>
            @endif
        </div>
</div>
</div>
