<?php
// Опишем переменную page:
$page = "Твои писюльки";
// Тут список моделек, нужных нам на текущий момент:
include "../models/mysql.php";
include "../models/menu.php";
// Список закончен. Модельки собирают данные из базы или конфига.
if ($_SESSION['id']){
    // Получение конкретно взятого списка сообщений:
    $messagesTo=freeContent("SELECT `id`, `user_from`, (SELECT `name` from `users` where `user_from` = `id`) as `from`, `user_to`,(SELECT `name` from `users` where `user_to` = `id`) as `to`,`message`,`date_message`,`date_read` FROM `messages` where `user_to` = '{$_SESSION['id']}'");
    $messagesFrom=freeContent("SELECT `id`, `user_from`, (SELECT `name` from `users` where `user_from` = `id`) as `from`, `user_to`,(SELECT `name` from `users` where `user_to` = `id`) as `to`,`message`,`date_message`,`date_read` FROM `messages` where `user_from` = '{$_SESSION['id']}'");
    // Число сообщений с авторизованным отправителем:
    $mCountBd = freeContent("SELECT count(`id`) as count FROM `messages` where `user_from` = '{$_SESSION['id']}'")[0]['count'];
    // Список пользователей без авторизованного:
    $userList = freeContent("SELECT id, nickname, name, surname FROM `users` WHERE id != '{$_SESSION['id']}'");
    // Если есть сообщение, то мы его высылаем...
    if ($_POST['message']){
        // Проверка, может ли он еще писать...
        if ($mCountBd < $mCount){
            // Получим и приведем данные на всякий случай:
            $user_to = abs(strip_tags($_POST['user_to']));
            $user_from = $_SESSION['id'];
            $message = strip_tags($_POST['message']);
            // Таблица для работы:
            $table = "messages";
            // Параметры для запроса:
            $params = "(`user_from`, `user_to`, `message`) VALUES ('{$user_from}', '{$user_to}', '{$message}')";
            // Сам запрос:
            addContent($table, $params);
        }
        // Переадресация на страницу сообщений после отправки:
        header("Location: /messages/");
        
    }
    if ($_GET['delete'] != ""){
        // Проверка прав на удаление: (Его ли сообщение)
        $params = "where (user_from = '{$_SESSION['id']}' or user_to = '{$_SESSION['id']}') and id = '{$_GET['delete']}'";
        $table = "messages";
        if (oneContent($table, $params)){
            // Удаление сообщения:
            $params="WHERE `id` = '{$_GET['delete']}'";
            // Удаление из БД!
            delContent($table, $params);
        }
        // Переадресация на страницу сообщений после удаления:
        header("Location: /messages/");
    }
    if ($_GET['read'] != ""){
        // Проверка прав на удаление: (Его ли сообщение)
        $params = "where user_to = '{$_SESSION['id']}' and id = '{$_GET['read']}'";
        $table = "messages";
        if (oneContent($table, $params)){
            // Получим дату в нужном формате и ее запишем:
            $today = date("Y-m-d");
            $params="SET `date_read` = '{$today}' where id = '{$_GET['read']}'";
            // Запишем в БД
            updContent($table, $params);
        }
        // Переадресация на страницу сообщений после прочтения:
        header("Location: /messages/");
    } 
}