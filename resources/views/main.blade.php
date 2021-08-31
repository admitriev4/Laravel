@include('template.header')

<div class="wrapper">
        <div class="auth-form">
            <p class="title-big">Войдите или зарегистрируйтесь</p>
            <form action="/users" method="post">
                {{ csrf_field() }}
                <span>E-mail:  <input type="text" name="login"><span class="red">{{$errors->first('login')}}</span></span>
                <span>Пароль:  <input type="password" name="password"><span class="red">{{$errors->first('password')}}</span></span>
                <input type="submit" value="Авторизация" class="btn">

            </form>
            @if (!empty($request))
                <div class="title-small red">{{$request}}</div>
            @endif
        </div>
</div>

@include('template.footer')
