<?php
// Опишем переменную page:
$page = "Твой мир";
// Тут список моделек, нужных нам на текущий момент:
include "../models/mysql.php";
include "../models/menu.php";
// Список закончен. Модельки собирают данные из базы или конфига.
// Опишем параметры запроса. (Пока общий вид)
$params="where id = '{$_SESSION['id']}'";
// Таблица, откуда будем забирать данные:
$table='users';
// Получим пользователя:
$user = oneContent($table, $params);

// Функция удаления пользовательского профиля с сайта:
function killUser($status){
    // Если функция вызвана, то:
    if (($_GET['kill'] != "1" && $_SESSION['id'] == $_GET['kill']) || ($_GET['kill'] != "1" && $status == "0" && $_GET['kill'] != "")){
        // Включим логику скуля для меньшей нагрузки на php:
        $params = " WHERE `user_id` = '{$_GET['kill']}'";
        // Работаем с табличкой комменариев:
        $table="comments";
        // Все комменты заданного юзера:
        $commentList = allContent($table, $params);
        // Перебор и удаление:
        foreach ($commentList as $comment){
            // Параметр запроса:
            $params="WHERE `id` = {$comment['id']}";
            // Удаление:
            delContent($table, $params);
        }
        // Удалить пользоваеля, который в системе.
        $params="WHERE `id` = {$_GET['kill']}";
        // Переключиться на таблицу пользователей:
        $table="users";
        // Убийство аватарки:
        if ($_SESSION['avatar'] != "null.jpeg"){
            // Удалим картинку:
            unlink("img/{$_SESSION['avatar']}");
        }
        // Убить!
        delContent($table, $params);
        if ($_SESSION['id'] == $_GET['kill']){
            // Выйти с сайта:
            include "../controllers/logout.php";
        }
        // Включить переадрес:
        header("Location: /admin/");
    }
}
// Функция завершена

// Функция модерирования комментариев:
function comMod(){
    if ($_GET['mod'] != ""){
        // Опишем параметры запроса. (Пока общий вид)
        $params="where id = '{$_GET['mod']}'";
        // Таблица, откуда будем забирать данные:
        $table='comments';
        // Получим из базы запись:
        $commentMod = oneContent($table, $params);
        if ($commentMod && $commentMod['status'] == "2" || $commentMod && $commentMod['status'] == "1"){
                // Если удален или опубликован, то восстановим в реестре до пупликации:
                // Опишем параметры запроса. (Пока общий вид)
                $params="SET `moder_id` = {$_SESSION['id']}, `status` = 0 where id = '{$_GET['mod']}'";
            } elseif ($commentMod && $commentMod['status'] == "0") {
                // А тут публикуем
                // Опишем параметры запроса. (Пока общий вид)
                $params="SET `moder_id` = {$_SESSION['id']}, `status` = 1 where id = '{$_GET['mod']}'";
            }
        // Произведем изменения в БД:
        updContent($table, $params);
        // И запустим переадрес...
        header("Location: /admin/");
    }
}
// Функция завершена

// Функция изменения комментариев:
function comEdit($status){
    // Изменение комментариев
    if ($_GET['edit'] == "2"){
        // Проверим коммент и статус юзера:
        // Опишем параметры запроса. (Пока общий вид)
        $params="where id = '{$_POST['post_id']}'";
        // Таблица, откуда будем забирать данные:
        $table='comments';
        // Получим коммент:
        $commentEdit = oneContent($table, $params);
        $name = strip_tags($_POST['name']);
        $text = strip_tags($_POST['text']);
        if ($commentEdit){
            if ($status == "0" || $status == "1"){
                // Опишем параметры запроса. (Пока общий вид) админ и модер могут всем править:
                $params="SET `name` = '{$name}', `text` = '{$text}' where id = {$_POST['post_id']}";
            } elseif ($status == "2" && $commentEdit['user_id'] == $_SESSION['id']) {
                // Опишем параметры запроса. (Пока общий вид), а юзер только себе:
                $params="SET `text` = '{$text}', `status` = '0', `moder_id` = null where id = {$_POST['post_id']}"; 
            }
            // Пишем в БД:
            updContent($table, $params);
            // Переадрес:
            header("Location: /admin");
        } else {
            // Если нет комментария, переадрес:
            header("Location: /admin");
        }
    }
}
// Функция завершена

// Функция модификации пользователя:
function userEdit($status, $avatar = ""){
    // Подфункция, генератор параметра:
    function genParams($avatar = ""){
        // Задаем входные данные:
        $params['name'] = strip_tags($_POST['name']);
        $params['surname'] = strip_tags($_POST['surname']);
        $params['avatar'] = $avatar;
        $params['password'] = strip_tags($_POST['password']);
        $string="SET";
        // Анализируем их:
        foreach ($params as $title => $value){
            // Логика оформления:
            if ($value != ""){
                // Прогенерим пароль:
                if ($title == "password"){
                    if ($value != "***"){
                    $value = password_hash($value, PASSWORD_DEFAULT);
                    } else {
                        break;
                    }
                }
                // Запишем в переменную:
                $string = "{$string} `{$title}` = '{$value}',";
            }
        }
        // Вернем готовый шаблон:
        return substr($string,0,-1)." where `id` = '{$_POST['user_id']}'";
    }
    // Если вызвали функцию, то для админа мы:
    if ($_GET['edit'] == '1' && $_SESSION['login'] != "" && $status == '0'){
        // Таблица, откуда будем забирать данные:
        $table='users';
        // Генерим параметры:
        $params = genParams($avatar);
        // Запишем что нить в БД:
        if ($avatar && $_SESSION['avatar'] != "admin.gif" && $_SESSION['avatar'] != "null.jpeg"){
            unlink("img/{$_SESSION['avatar']}");
        }
        updContent($table, $params);
        // Переадрес:
        header("Location: /admin");
    }elseif ($_SESSION['id'] == $_POST['user_id']){
        // Таблица, откуда будем забирать данные:
        $table='users';
        // Генерим параметры:
        $params = genParams($avatar);
        // Запишем что нить в БД:
        if ($avatar && $_SESSION['avatar'] != "admin.gif" && $_SESSION['avatar'] != "null.jpeg"){
            unlink("img/{$_SESSION['avatar']}");
        }
        updContent($table, $params);
        // Автоподстановка аватарки:
        if ($avatar){
            $_SESSION['avatar'] = $avatar;
        }
        // Переадрес:
        header("Location: /admin");
    }
}
// Функция завершена

// Функция удаления комментариев:
function delComment($status){
    if ($_GET['delete'] != ""){
        // Таблица, откуда будем забирать данные:
        $table='comments';
        if ($status == "1"){
            // Параметр запроса для модератора:
            $params="SET `moder_id` = '{$_SESSION['id']}', `status` = 2 where id = '{$_GET['delete']}'";
            // Для них одна команда, но админский блок будет чуть другой
            updContent($table, $params);
        } elseif ($status == "2"){
            // Параметр запроса для пользователя:
            $params="SET `status` = '2' where id = '{$_GET['delete']}'";
            // Для них одна команда, но админский блок будет чуть другой
            updContent($table, $params);
        } elseif ($status == "0"){
            // Опишем параметры запроса. (Пока общий вид)
            $params="WHERE `id` = '{$_GET['delete']}'";
            // Удаление из БД для админа!
            delContent($table, $params);
        }
        // И запустим переадрес...
        header("Location: /admin/");
    }
}
// Функция завершена

// Функция изменения статуса пользователя:
function userMod(){
    if ($_GET['userMod'] != $_SESSION['id'] && $_GET['userMod'] != '1' && $_GET['userMod'] != ""){
        // Пропишем параметр:
        $params = "where id = '{$_GET['userMod']}'";
        // Таблица:
        $table = "users";
        // Получим пользователя:
        $userMod = oneContent($table, $params);
        // Дадим параметр согласно статусу (Модер или админ):
            if ($userMod['status'] == 2){
                $params = "SET `status` = '1' where id = '{$_GET['userMod']}'";
            } else {
                $params = "SET `status` = '2' where id = '{$_GET['userMod']}'";   
            }
        // Запишем в БД:
        updContent($table, $params);
        // Переадресуем:
        header("Location: /admin/");
    }
}
// Функция завершена

// Функция изменения поста:
function postEdit($avatar){
    if ($_GET['edit'] =="3"){
        // Функционал только для админа!
        $params="where id = '{$_POST['postId']}'";
        // Таблица, откуда будем забирать данные:
        $table='posts';
        // Сама запись:
        $postEdit = oneContent($table, $params);
        // Пишем параметр, если есть автарка или её нет:
        if ($postEdit){
            if ($avatar){
                $params="SET `title` = '{$_POST['postTitle']}', `text` = '{$_POST['postText']}', `image` = '{$avatar}' where id = '{$_POST['postId']}'";
            } else {
                $params="SET `title` = '{$_POST['postTitle']}', `text` = '{$_POST['postText']}' where id = '{$_POST['postId']}'";
            }
            // Пишем в БД:
            updContent($table, $params);
            // Переадрес:
            header("Location: /admin/");
        } else {
            // Ничего не делаем и переадрес:
            header("Location: /admin/");
        }
    }
}
// Функция завершена

// Функция сброса счетчика прочтений:
function postReset(){
    if ($_GET['kill'] != ""){
        // Функционал только для админа!
        $params="where id = '{$_GET['kill']}'";
        // Таблица, откуда будем забирать данные:
        $table='posts';
        // Сама запись
        $postEdit = oneContent($table, $params);
        // Допроверка на наличие:
        if ($postEdit){
            // Сброс счетчика:
            $params="SET `reading` = '0' where id = '{$_GET['kill']}'";
            // Запись в БД:
            updContent($table, $params);
            // Переадрес:
            header("Location: /admin/");
        } else {
            // Переадрес:
            header("Location: /admin/");
        }
    }
}
// Функция завершена

// Функция сброса аватара записи:
function postAvatarReset(){
    if ($_GET['killImg'] != ""){
        // Функционал только для админа!
        $params="where id = '{$_GET['killImg']}'";
        // Таблица, откуда будем забирать данные:
        $table='posts';
        // Сама запись:
        $postEdit = oneContent($table, $params);
        if ($postEdit){
            // Удалим картинку:
            unlink("img/{$postEdit['image']}");
            // Сгенерим об этом запись:
            $params="SET `image` = '' where id = '{$_GET['killImg']}'";
            // Внесем изменения в БД:
            updContent($table, $params);
            // Переадрес:
            header("Location: /admin/");
        } else {
            // Переадрес:
            header("Location: /admin/");
        }
    }
}
// Функция завершена

// Функция сброса аватара пользователя:
function userAvatarReset($status){
    if (($_GET['killAvatar'] != "1" && $_GET['killAvatar'] == $_SESSION['id']) || ($_GET['killAvatar'] != "" && $status == "0")){
        // Параметр запроса:
        $params="where id = '{$_GET['killAvatar']}'";
        // Таблица, откуда будем забирать данные:
        $table='users';
        // Сама запись:
        $user = oneContent($table, $params);
        if ($user){
            // Удалим картинку:
            if ($user['avatar'] != "admin.gif" && $user['avatar'] != "null.jpeg"){
                unlink("img/{$user['avatar']}");
            }
            // Сгенерим об этом запись:
            if ($user['id'] == "1"){
                $params="SET `avatar` = 'admin.gif' where id = '{$_GET['killAvatar']}'";
            } else {
                $params="SET `avatar` = '' where id = '{$_GET['killAvatar']}'";
            }
            // Внесем изменения в БД:
            updContent($table, $params);
            // Переадрес:
            header("Location: /admin/");
        } else {
            // Переадрес:
            header("Location: /admin/");
        }
    }
}
// Функция завершена

// Функция добавления записи:
function addPost($avatar){
    // Если есть флаг на добавление, то
    if ($_GET['addPost'] == "1"){
        // Только для админа: (добавить стих)
        if ($avatar){
            $params="(`title`, `text`, `image`) VALUES ('{$_POST['postTitle']}', '{$_POST['postText']}', '{$avatar}')";
        } else {
            $params="(`title`, `text`) VALUES ('{$_POST['postTitle']}', '{$_POST['postText']}')";
        }
        // Таблица, куда будем писать данные:
        $table='posts';
        // Запишем в БД:
        addContent($table, $params);
        // Переадрес:
        header("Location: /admin/");
    }
}
// Функция завершена:

// Функция удаления записи:
function delPost(){
    if ($_GET['deletePost'] != ""){
        // Удалим пост (админский уровень)
        $params = " WHERE `post_id` = '{$_GET['deletePost']}'";
        // Таблица, с которой работаем:
        $table='comments';
        // Получим комментарии:
        $commentList = allContent($table);
        // Проверяет скуль...
        foreach ($commentList as $comment){
            // Пробежим по комментам:
            $params = "WHERE `id` = {$comment['id']}";
            // И их грохнем:
            delContent($table, $params);
        }
        // Получим запись:
        $params="where id = '{$_GET['deletePost']}'";
        // Таблица, откуда будем забирать данные:
        $table='posts';
        // Сама запись:
        $postEdit = oneContent($table, $params);
        if ($postEdit){
            // Удалим картинку:
            unlink("img/{$postEdit['image']}");
        }
        // Напишем запрос на проханье поста:
        $params="WHERE `id` = {$_GET['deletePost']}";
        // С рабочей таблицей:
        $table='posts';
        // Грохнем его:
        delContent($table, $params);
        // Переадрес:
        header("Location: /admin/");
    }
}
// Функция завершена

// Блок проверок на соответствие и запуск нужного функционала:
if ($user['status'] == "2"){
    // Получим список комментариев:
    $commentList = freeContent("SELECT id, post_id, (select title from posts where post_id = id limit 1) as title, name, text, `user_id`, (select nickname from users where `user_id` = id limit 1) as nickname, moder_id, (select nickname from users where moder_id = id limit 1) as moder, status FROM `comments` where `user_id` = {$_SESSION['id']} and status != 2");
    // Пользователь может: Удалить свой коммент (пометить удаленным)
    delComment($user['status']);
    // Пользователь может: Менять свои данные (в том числе аватар)
    userEdit($user['status'], $avatar);
    // Пользователь может: Изменять комментарии (только свои)
    comEdit($user['status']);
    // Пользователь может: Убить себя об стенку...
    killUser($user['status']);
    // Сбор аватарки:
    userAvatarReset($user['status']);
    // Перекидываем собранную информацию во вьюху пользователя:
    $controller = "user";
}elseif ($user['status'] == "1"){
    // Получим список всех комментариев:
    $commentList = freeContent("SELECT id, post_id, (select title from posts where post_id = id limit 1) as title, name, text, `user_id`, (select nickname from users where `user_id` = id limit 1) as nickname, moder_id, (select nickname from users where moder_id = id limit 1) as moder, status FROM `comments`");
    // Модератор может: Удалить любой коммент (пометить удаленным)
    delComment($user['status']);
    // Модератор может: Модерировать комментарии (публиковать/снимать с публикации)
    comMod();
    // Модератор может: Менять комментарии и авторов комментариев (Всех)
    comEdit($user['status']);
    // Модератор может: Менять свои данные (в том числе аватар)
    userEdit($user['status'], $avatar);
    // Модератор может: Убить себя об стенку...
    killUser($user['status']);
    // Сбор аватарки:
    userAvatarReset($user['status']);
    // Перекидываем собранную информацию во вьюху модератора:
    $controller = "moder";
}elseif ($user['status'] == "0"){
    // Получим список пользователей:
    $userList = allContent($table);
    // Таблица, откуда будем забирать данные:
    $table='posts';
    // Получим список записей:
    $postList = allContent($table);
    // Получим список всех комментариев:
    $commentList = freeContent("SELECT id, post_id, (select title from posts where post_id = id limit 1) as title, name, text, email, `user_id`, (select nickname from users where user_id = id limit 1) as nickname, moder_id, (select nickname from users where moder_id = id limit 1) as moder, status FROM `comments`");
    // Администратор может: Удалить комментарии (совсем удалить)
    delComment($user['status']);
    // Администратор может: Модерировать комментарии (публиковать/снимать с публикации)
    comMod();
    // Администратор может: Менять комментарии и авторов комментариев (Всех)
    comEdit($user['status']);
    // Администратор может: Менять личные данные (в том числе аватар) у любого пользователя!
    userEdit($user['status'], $avatar);
    // Исключительно админские привелегии:
    // Повышение или понижение прав юзверя:
    userMod();
    // Поправить ошибки в посте:
    postEdit($avatar);
    // Удалить прочтения поста:
    postReset();
    // Удалить аватар поста:
    postAvatarReset();
    // Добавляем запись
    addPost($avatar);
    // Удаляем запись:
    delPost();
    // Администратор может: Удалять всех, кроме себя...
    killUser($user['status']);
    // Сбор аватарки:
    userAvatarReset($user['status']);
}
// Админ панели реализованы.