<?php
// Опишем переменную page:
$page = "Главная страница";
// Тут список моделек, нужных нам на текущий момент:
include "../models/mysql.php";
include "../models/menu.php";
// Список закончен. Модельки собирают данные из базы или конфига.
if(freeContent("SHOW TABLES like 'posts'") && freeContent("SHOW TABLES like 'comments'") && freeContent("SHOW TABLES like 'users'")&& freeContent("SHOW TABLES like 'messages'")){
    // Опишем параметры запроса. (Пока общий вид)
    $pMax = (int)((freeContent("SELECT count(id) as postCount FROM `posts`")['0']['postCount'] - 1) / $pCount);
    // Тут мы получили максимум страниц, далее принимаем страничку...
    if ($_GET['page']){
        // Генерим точку старта запроса:
        $p = abs((int)$_GET['page'])*$pCount;
        $params="order by id desc LIMIT $pCount OFFSET $p";
    } else {
        $params="order by id desc LIMIT $pCount OFFSET 0";
    }
    // Таблица, откуда будем забирать данные:
    $table='posts';
    // Выдернем все посты и положим их в нашу переменку:
    $posts=allContent($table, $params);
    // Опишем параметры запроса. (Пока общий вид)
    $params='where `id` = 1';
    // Таблица, откуда будем забирать данные:
    $table='users';
    // Выдернем админа:
    $admin=oneContent($table, $params);
    // Аватар админки:
    $img=$admin['avatar'];
} else {
    $controller = "setup";
    include "../controllers/{$controller}.php";
}