<?php
// Опишем переменную page:
$page = "Вход на сайт";
// Тут список моделек, нужных нам на текущий момент:
include "../models/mysql.php";
// Список закончен. Модельки собирают данные из базы или конфига.
// Пишем переменную навигации:
$menu='<a onclick="javascript:history.back(); return false;" title="Назад в будущее!">Назад</a>';

// Сброс пароля:
if ($_POST['login'] != ""){
    // Запрос на сброс пароля:
    $params="where `nickname` = '{$_POST['login']}'";
    // Ищем пользователя
    $table="users";
    // Запрос к БД
    $user=oneContent($table, $params);
    // Если находим, то:
    if ($user){
        // Заводим некий токен для работы системы:
        function genToken(){
            $token = substr(md5(time()), 0, 4);
            $table="users";
            $params = "where `token` = '{$token}'";
            if (oneContent($table, $params)){
                genToken();
            } else {
                return $token;
            }
        } // Выше написана проверка наличия токена и перегенерация его при случайном совпадении (Дыра безопасности закрыта)
        $token = genToken();
        // Запишем токен
        $params = "SET `token` = '{$token}' where nickname = '{$_POST['login']}'";
        // Добавим в БД
        updContent($table, $params);
        // Формируем сообщение на почту:
        $message = "Доброе время суток, Ваша ссылка сброса пароля:\r\n http://programmer-tm.h1n.ru/reset/?resetPassword=$token";
        // Тут почта, куда скинем ссылочку:
        $email = $user['email'];
        // Отправляем
        mail($email, 'Сброс пароля', $message);
        // Формируем сообщение на страничку:
        $_SESSION['message'] = "Вам отправлено письмо со ссылкой на сброс пароля";
    } else {
        $_SESSION['message'] = "А вот врать не хорошо ;-)";
    }
    // Фенкция ссброса пароля:
} elseif (($_GET['resetPassword'] != "" || $_GET['resetPassword'] != "1") && $_POST['password'] != ""){
    // Ищем пользователя по токену:
    $params="where `token` = '{$_GET['resetPassword']}'";
    // Получим его из таблицы:
    $table="users";
    // И пропишем в переменную
    $user=oneContent($table, $params);
    if ($user){
        // Пользователь есть, значит:
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        // Сделали пароль, и обновили его в БД с анулированием токена.
        $params = "SET `password` = '{$password}', `token` = '' where `id` = '{$user['id']}'";
        // Записали в БД
        updContent($table, $params);
        // Написали на почту об этом:
        $nick=$user['nickname'];
        $pass=$_POST['password'];
        // Формируем сообщение о сбросе пароля:
        $message = "Доброе время суток, Вы сменили пароль на сайте $title.\r\n Ваш логин: $nick\r\nВаш пароль: $pass\r\nНе забывайте эти данные.";
        // Тут почта, куда скинем ссылочку:
        $email = $user['email'];
        // Отправляем
        mail($email, 'Сброс пароля', $message);
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
        $_SESSION['message'] = 'Приветствуем, '.$user['nickname'].'!';
    } else {
        header("Location: /");
    }
}