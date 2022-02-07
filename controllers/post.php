<?php
// Тут список моделек, нужных нам на текущий момент:
include "../models/mysql.php";
include "../models/menu.php";
// Список закончен. Модельки собирают данные из базы или конфига.

// Опишем параметры запроса. (Пока общий вид)
$params="where id = ".abs($_GET['id']);
// Таблица, откуда будем забирать данные:
$table='posts';
// Выдернем пост и положим его в нашу переменку:
$post=oneContent($table, $params);

// Опишем параметры запроса. (Пока общий вид)
$params='where `id` = 1';
// Таблица, откуда будем забирать данные:
$table='users';
// Выдернем админа:
$admin=oneContent($table, $params);
$img=$admin['avatar'];

// Проверим, выдралось ли что-либо:
if ($post){
    // Таблица, откуда будем забирать данные:
    $table='posts';
    // Опишем переменную page:
    $page = $post['title'];
    // Коли нашли пост, то мы ему приплюсуем статус прочтения:
    $reading = ++$post['reading'];
    // Впишем сие модификатор в БД:
    $params="SET `reading` = '{$reading}' where `id` = '{$_GET['id']}'";
    // Обновление записи в БД согласно id поста.
    updContent($table, $params);

    // Таблица, откуда будем забирать данные:
    $table="comments";
    // Опишем параметры запроса. (Пока общий вид)
    //$params="WHERE post_id = '{$_GET['id']}'";
    // Выдернем все комменты и положим их в нашу переменку:
    //$comments=allContent($table, $params);
    $comments=freeContent("SELECT comments.name, comments.text, comments.user_id, comments.status, users.avatar  FROM `comments` join `users` on users.id = comments.user_id where post_id = '{$_GET['id']}'");
    // Включим счетчик:
    $commentCount = 0;
    // Если есть список, то:
    if ($comments){
        // Перебор списка:
        foreach ($comments as $com){
        // Если есть коммент со статусом опубликовано:
            if ($com['status'] == 1){
            // Фиксируем это в значении счетчика, чтобы на фронте не считать
                $commentCount = ++$commentCount;
                // Пишем в новый массив коммент.
                $newComments[]=$com;
            }
        }
        // Переобработка массива комментов:
        if ($newComments != ""){
            // Заново наполним только живыми комментами массив.
            $comments = $newComments;
        }
    }

    // Проверим текст коммента, если есть, то делаем что-то...
    if ($_POST['text']){
        // Проверим, залогинен ли кто-то.
        if ($_SESSION['id'] != ""){
            // Залогинен. Получим пользователя из БД.
            $params = "where id = '{$_SESSION['id']}'";
            // Табличка бд с пользователями
            $table = "users";
            // Получили и положили его в переменную:
            $user = oneContent($table, $params);
            // Пишем данные юзверя, который залогинен:
            $text = strip_tags($_POST['text']);
            // Переназначение переменных, очистка от тегов!
            if ($_SESSION['id'] == '1'){
                $params = "(`post_id`, `name`, `email`, `text`, `user_id`, `status`) VALUES ('{$_GET['id']}', '{$user['name']}', '{$user['email']}', '{$text}', '{$_SESSION['id']}', '1')";
            } else {
                $params = "(`post_id`, `name`, `email`, `text`, `user_id`, `status`) VALUES ('{$_GET['id']}', '{$user['name']}', '{$user['email']}', '{$text}', '{$_SESSION['id']}', '0')";
            }       
        } else {
            //Иначе пишем без него:
            // Переназначение переменных, очистка от тегов!
            $name = strip_tags($_POST['name']);
            $email = strip_tags($_POST['email']);
            $text = strip_tags($_POST['text']);
            // Переназначение переменных, очистка от тегов!
            $params = "(`post_id`, `name`, `email`, `text`, `status`) VALUES ('{$_GET['id']}', '{$name}', '{$email}', '{$text}', '0')";    
        }
        // Таблица для записи:
        $table = "comments";
        // Операция записи
        addContent($table, $params);
        // Отправим сообщение пользователю об успехе
        $_SESSION['message'] = 'Комментарий отправлен на рассмотрение';
    }
} elseif ($_GET['id'] == "0") {
    if ($_POST['text']){
        // Проверим, залогинен ли кто-то.
        if ($_SESSION['id'] != ""){
            // Залогинен. Получим пользователя из БД.
            $params = "where id = '{$_SESSION['id']}'";
            // Табличка бд с пользователями
            $table = "users";
            // Получили и положили его в переменную:
            $user = oneContent($table, $params);
            // Пишем данные юзверя, который залогинен:
            $text = strip_tags($_POST['text']);
            // Переназначение переменных, очистка от тегов!
            if ($_SESSION['id'] == '1'){
                $params = "(`post_id`, `name`, `email`, `text`, `user_id`, `status`) VALUES ('{$_GET['id']}', '{$user['name']}', '{$user['email']}', '{$text}', '{$_SESSION['id']}', '1')";
            } else {
                $params = "(`post_id`, `name`, `email`, `text`, `user_id`, `status`) VALUES ('{$_GET['id']}', '{$user['name']}', '{$user['email']}', '{$text}', '{$_SESSION['id']}', '0')";
            }       
        } else {
            //Иначе пишем без него:
            // Переназначение переменных, очистка от тегов!
            $name = strip_tags($_POST['name']);
            $email = strip_tags($_POST['email']);
            $text = strip_tags($_POST['text']);
            // Переназначение переменных, очистка от тегов!
            $params = "(`post_id`, `name`, `email`, `text`, `status`) VALUES ('{$_GET['id']}', '{$name}', '{$email}', '{$text}', '0')";    
        }
        // Таблица для записи:
        $table = "comments";
        // Операция записи
        addContent($table, $params);
        // Отправим сообщение пользователю об успехе
        $_SESSION['message'] = 'Комментарий отправлен на рассмотрение';
    }
    header("Location: ".$_SERVER['HTTP_REFERER']);
}