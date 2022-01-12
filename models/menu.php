<?php
// Делаем менюшку, отображающую пользователя:
if ($_SESSION["login"] != ""){
    // Если мы нашли пользователя, то отобразим его на морде через переменку:
    $menu = $_SESSION['login'].' (<a href="/messages/" title="Непрочитанных сообщений: '.$messagesNotRead.'">'.$messagesNotRead.'</a>)<a title="Приветствуем тебя, пользователь: '.$_SESSION['login'].'" href="/admin/"><img src="/img/'.$_SESSION['avatar'].'" alt="'.$_SESSION['login'].'" align="left" hspace="2" class="menu-img"><br>(Личный кабинет)</a><br><a href="/logout">Выход</a>';
} else {
    // Если никто не залогинен, то отобразим ссылку на вход.
    $menu = '<form action="/register/" method="post" enctype="multipart/form-data">
    <label for="login"><b>Логин:</b></label>
    <input type="text" placeholder="Введите логин" name="login" size = 18 required><br>
    <label for="password"><b>Пароль:</b></label>
    <input type="password" placeholder="Введите пароль" size = 18 name="password" required><br>
    <button type="submit">Вход</button>
    <button type="reset" class="cancelbtn">Очистить форму</button><br>
    <a href="/reset/" title="Сброс пароля">Забыл пароль?</a> | <a href="/register/">Регистрация!</a>
</form>';
}