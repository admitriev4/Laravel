@include('template.header')

<div class="wrapper">
        <div class="auth-form">
            <p class="title-big">Войдите или зарегистрируйтесь</p>
            <form action="" method="post">
                <span>E-mail:  <input type="text" name="login"></span>
                <span>Пароль:  <input type="password" name="password"></span>
                <input type="submit" value="Авторизация" class="btn">

            </form>
            <a href="/registration/" class="btn">Регистрация</a>
        </div>
</div>

@include('template.footer')
