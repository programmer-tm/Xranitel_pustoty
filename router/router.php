<?php
// Смотрим сессию:
session_start();
// Получим имя контроллера: он же директория, куда пытаемся провалиться.
$controller=explode('/', $_SERVER['REQUEST_URI'])[1];
// Ежели тама пусто, то пиннём вошедшего на главнюк контроллер.
if ($controller == "" || stripos($controller, "?page=") !== false ){
    $controller="index";
    include "../controllers/$controller.php";
} elseif(file_exists("../controllers/$controller.php")) {
    // Иначе, если есть контроллер с таким неймом, то пиннем юзверя на него.
    include "../controllers/$controller.php";
} else {
    // Ежели всё совсема плохо, то вытащим его в ошибочную шнягу...
    $message = "error";
}
// Передача на рендер вьюхи, согласно имеющегося контроллерса:
include "../models/render.php";
// Примуслякаем всему этому основной шаблоний:
include '../views/main.php';
// На сиём роутер закончен. Его обязанности раскидывать исполнение на другие участки кода.