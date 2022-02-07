<?php
// Делаем менюшку, отображающую пользователя:
if ($_SESSION["login"] != ""){
    // Если мы нашли пользователя, то отобразим его на морде через переменку:
    $userAvatar = ($_SESSION['avatar']) ?: 'null.jpeg';
    $menu = $_SESSION['login'].' (<a href="/messages/" title="Непрочитанных сообщений: '.$messagesNotRead.'">'.$messagesNotRead.'</a>)<a title="Приветствуем тебя, пользователь: '.$_SESSION['login'].'" href="/admin/"><img src="/img/'.$userAvatar.'" alt="'.$_SESSION['login'].'" align="left" hspace="2" class="menu-img"><br>(Личный кабинет)</a><br><a href="/logout">Выход</a>';
} else {
    // Если никто не залогинен, то отобразим ссылку на вход.
    $menu = '<form action="/register/" method="post" enctype="multipart/form-data">
    <input class="form_in_menu" type="text" placeholder="Введите логин" name="login" required><br>
    <input class="form_in_menu" type="password" placeholder="Введите пароль" name="password" required><br>
    <center><button type="submit">Вход</button>
    <button type="reset" class="cancelbtn">Очистить</button></center><br>
    <a href="/reset/" title="Сброс пароля">Забыл пароль?</a> | <a href="/register/">Регистрация</a>
</form>';
}