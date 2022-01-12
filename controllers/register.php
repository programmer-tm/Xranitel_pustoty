<?php
// Опишем переменную page:
$page = "Регистрация нового пользователя";
// Тут список моделек, нужных нам на текущий момент:
include "../models/mysql.php";
// Список закончен. Модельки собирают данные из базы или конфига.
// Пишем переменную навигации:
$menu='<a onclick="javascript:history.back(); return false;" title="Назад в будущее!">Назад</a>';

// Обеспечиваем логин и разлогин юзеров (пароль в открытом виде!!!):
if ($_POST['login'] && $_POST['password'] && !$_SESSION['login'])
{
    // Опишем параметры запроса. (Пока общий вид)
    $params="where `nickname` = '{$_POST['login']}'";
    // Таблица, откуда будем забирать данные:
    $table='users';
    // Запрашиваем пользователя из БД:
    $user = oneContent($table, $params);
    // Если таковая запись есть, то:
    if ($user){
        // Проверяем пароль на соответствие:
        if (password_verify($_POST['password'], $user['password'])){
            // Опишем параметры запроса. (Пока общий вид)
            $params="SET `token` = '' where `nickname` = '.{$_POST['login']}.'";
            // Коль все хорошо, то мы чистим токен на сброс пароля, коль он был или не был
            updContent($table, $params);
            // Впишем ид юзера:
            $_SESSION["id"] = $user['id'];
            // Впишем логин
            $_SESSION['login'] = $user['nickname'];
            // Впишем аву юзера:
            if ($user['avatar'] == ""){
                // Коль нет авы - грустный слоник :-)
                $_SESSION["avatar"] = "null.jpeg";
            } else {
                // Иначе - аватарку даем
                $_SESSION["avatar"]=$user['avatar'];
            }
            // Отправим сообщение пользователю об успехе
            $_SESSION['message'] = 'Приветствуем, '.$user['nickname'].'!';
        } else {
            // Отправим сообщение пользователю о неудаче
            $_SESSION['message'] = 'Внимание неверный пароль!';
        }
    } else {
        // Отправим сообщение пользователю о неудаче
        $_SESSION['message'] = 'Внимание Такого пользователя нет на сайте!';
    }
} elseif ($_POST['nickname'] && $_POST['name'] && $_POST['surname'] && $_POST['email'] && $_POST['password'] && $_POST['password2']){
    // Опишем параметры запроса. (Пока общий вид)
    $params="where `nickname` = '{$_POST['nickname']}'";
    // Таблица, откуда будем забирать данные:
    $table='users';
    // Запрашиваем пользователя из БД:
    $user = oneContent($table, $params);
    if (!$user){
        // Опишем параметры запроса. (Пока общий вид)
        $params="where `email` = '".$_POST['email']."'";
        // Запрашиваем пользователя из БД:
        $user = oneContent($table, $params);
        if (!$user){
            // Коль нет пользователя, мы проверим правильность повтора пароля:
            if ($_POST['password'] == $_POST['password2']){
                // Все удачно, генерим хеш:
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                // Опишем параметры запроса. (Пока общий вид)
                // Переназначение переменных, очистка от тегов!
                $nickname = strip_tags($_POST['nickname']);
                $name = strip_tags($_POST['name']);
                $surname = strip_tags($_POST['surname']);
                $email = strip_tags($_POST['email']);
                $params="(`nickname`, `name`, `surname`, `email`, `password`, `status`) VALUES ('{$nickname}', '{$name}', '{$surname}', '{$email}', '{$password}', '2')";
                // Запишем пользователя в БД
                addContent($table, $params);
                // Опишем параметры запроса. (Пока общий вид)
                $params="SET `token` = '' where `nickname` = '.{$_POST['nickname']}.'";
                // Коль все хорошо, то мы чистим токен на сброс пароля, коль он был или не был
                updContent($table, $params);
                // Запросим пользователя из БД:
                $params="where `nickname` = '{$_POST['nickname']}'";
                // Запрашиваем пользователя из БД:
                $user = oneContent($table, $params);
                // Впишем ид юзера:
                $_SESSION["id"] = $user['id'];
                // Впишем логин
                $_SESSION['login'] = $user['nickname'];
                // Впишем аву юзера:
                if (is_null($user['avatar'])){
                    $_SESSION["avatar"] = "null.jpeg";
                } else {
                    $_SESSION["avatar"] = $user['avatar'];
                }
                // Составим письмо об успешной регистрации на почту:
                $nick = $user['nickname'];
                $pass = $user['password'];
                $message = "Доброе время суток, Вы зарегистрировались на сайте $title.\r\n Ваш логин: $nick\r\nВаш пароль: $pass\r\nНе забывайте эти данные.";
                // Тут почта, куда скинем ссылочку:
                $email = $user['email'];
                // Отправляем
                mail($email, 'Регистрация на сайте', $message);
            } else {
                $_SESSION['message'] = 'Пароли не совпадают!';
            }
        } else {
            $_SESSION['message'] = 'Пользователь с таким email уже есть на сайте!';
        }
    } else {
        $_SESSION['message'] = 'Пользователь с таким логином уже есть на сайте!';
    }
}