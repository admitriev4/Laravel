@include('template.header')

<div class="wrapper">
    <div class="reg-form">
    <p class="title-big center">Изменение пароля пользователя</p>
    <form action="/user/update_pass" method="post">
        {{ csrf_field() }}
        <span>Старый пароль: <input type="password" name="old_password"> <span class="red">{{$errors->first('password')}}</span></span>
        <span>Пароль: <input type="password" name="password"> <span class="red">{{$errors->first('password')}}</span></span>
        <span>Повторить пароль: <input type="password" name="repeat_password">  <span class="red">{{$errors->first('repeat_password')}}</span></span>
        <input type="submit" value="Регистрация" class="btn">
    </form>
</div>
</div>

@include('template.footer')
