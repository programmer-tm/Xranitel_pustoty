<?php
// Парсим конфиг:
$config = parse_ini_file("../config/config.ini", true);
// Извлекаем параметры из конфига:
// Имя сайта:
$title = $config['title'];
// Адрес сервера mysql:
$mysql = $config['mysql'];
// Порт сервера mysql:
$mysqlPort = $config['port'];
// Логин подключения к серверу БД:
$mysqlLogin = $config['login'];
// Пароль для подключения к серверу БД:
$mysqlPassword = $config['password'];
// Имя базы данных:
$datebase = $config['bd'];
// Максимально постов на странице:
$pCount = $config['pCount'];
// Максимально постов на странице:
$mCount = $config['mCount'];
// Ссылки:
$links = $config['links'];
// Закончили парсить конфиг

// Проверка на наличие ограничений:
if (!$pCount){
    // Выставляем длинные ограничения. Максимально.
    $pCount = "99999999";
}
if (!$mCount){
    // Выставляем длинные ограничения. Максимально.
    $mCount = "99999999";
}

// Делаем коннект к БД:
function dbConnect($mysql, $mysqlPort, $mysqlLogin, $mysqlPassword, $datebase){
    if (!$db){
        // Подключение с параметрами из конфига:
        $db = mysqli_connect($mysql.":".$mysqlPort, $mysqlLogin, $mysqlPassword, $datebase);
        if ($db){
            // Кодировка:
            mysqli_set_charset($db, "utf8");
        }
    } 
    return $db;
}

$db = dbConnect($mysql, $mysqlPort, $mysqlLogin, $mysqlPassword, $datebase);

// Получить список значений
function allContent($table, $params = ""){
    global $db;
    return mysqli_fetch_all(mysqli_query($db, "SELECT * FROM {$table} {$params}"), MYSQLI_ASSOC);;
}
// Получить 1 значение
function oneContent($table, $params = ""){
    global $db;
    return mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM {$table} {$params}"));
}
// Обновить значения
function updContent($table, $params){
    global $db;
    mysqli_query($db, "UPDATE {$table} {$params}");
}
// Добавить значения
function addContent($table, $params){
    global $db;
    mysqli_query($db, "INSERT INTO {$table} {$params}");
}
// Удалить значение
function delContent($table, $params){
    global $db;
    mysqli_query($db, "DELETE FROM {$table} {$params}");
}
// Свободный запрос
function freeContent($sql){
    global $db;
    return mysqli_fetch_all(mysqli_query($db, $sql), MYSQLI_ASSOC);
}
// Test_setup_block
function addTable($params){
    global $db;
    mysqli_query($db, $params);
}

// Список закончен. Модельки собирают данные из базы или конфига.
if ($db && freeContent("SHOW TABLES like 'posts'") && freeContent("SHOW TABLES like 'comments'") && freeContent("SHOW TABLES like 'users'")&& freeContent("SHOW TABLES like 'messages'")){
    $commentsSite = freeContent("SELECT name, text, `user_id`, (select avatar from users where user_id = id limit 1) as avatar FROM `comments` where `post_id` = 0 and status = 1 order by id desc limit 3");
}

if ($_SESSION['id']){
    $messagesNotRead = freeContent("SELECT count(user_to) as count FROM `messages` WHERE `user_to` = '{$_SESSION['id']}' and `date_read` is null")[0]['count'];
}