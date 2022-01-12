<?php
// Опишем переменную page:
$page = "Установить!";
// Тут список моделек, нужных нам на текущий момент:
if (!$title){
  include "../models/mysql.php";
}
// Запрос на наличие Таблиц: (если есть, то уходим с установки восвояси!)
if(freeContent("SHOW TABLES like 'posts'") && freeContent("SHOW TABLES like 'comments'") && freeContent("SHOW TABLES like 'users'")){
  header("Location: /");
} else {
  session_destroy();
}
// Иначе проверим флаг установки: (поля, коль не дурак, забивает точно)
if ($_GET['done'] == '1'){
  // Очищаем БД от старых таблиц!
  $params = "DROP TABLE `comments`, `posts`, `users`;";
  addTable($params);
  // Блок очистки закончен
  // Установим таблицы заново:
  $params = "CREATE TABLE `comments` (
    `id` int(11) NOT NULL,
    `post_id` int(11) NOT NULL,
    `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `user_id` int(11) DEFAULT NULL,
    `moder_id` int(11) DEFAULT NULL,
    `status` int(11) NOT NULL DEFAULT 0
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
  addTable($params);
  // Комменты залили
  $params = "CREATE TABLE `posts` (
    `id` int(255) NOT NULL,
    `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `reading` int(255) NOT NULL DEFAULT 0,
    `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
  addTable($params);
  // Посты залили
  $params = "CREATE TABLE `users` (
    `id` int(255) NOT NULL,
    `nickname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    `surname` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
    `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `status` int(11) NOT NULL DEFAULT 2,
    `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `token` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
  addTable($params);
  // Юзеров залили
  $params = "CREATE TABLE `messages` (
    `id` int(255) NOT NULL,
    `user_from` int(255) NOT NULL,
    `user_to` int(255) NOT NULL,
    `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `date_message` date NOT NULL DEFAULT current_timestamp(),
    `date_read` date DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
  addTable($params);
  // Залили таблицу личных сообщений
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  // Вписывание админа на сайт:
  $params = "INSERT INTO `users` (`id`, `nickname`, `name`, `surname`, `email`, `avatar`, `status`, `password`, `token`) VALUES
  (1, '{$_POST['nickname']}', '{$_POST['name']}', '{$_POST['surname']}', '{$_POST['email']}', 'admin.gif', 0, '{$password}', '');";
  addTable($params);
  // Добавим логику БД:
  $params = "ALTER TABLE `comments`
    ADD PRIMARY KEY (`id`);";
  addTable($params);
  // Для комментов
  $params = "ALTER TABLE `posts`
    ADD PRIMARY KEY (`id`);";
  addTable($params);
  // Для постов
  $params = "ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `nickname` (`nickname`),
    ADD UNIQUE KEY `email` (`email`);";
  addTable($params);
  // Для пользователей
  $params = "ALTER TABLE `comments`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;";
  addTable($params);
  // Обнуляем автоинкременты...
  $params = "ALTER TABLE `posts`
    MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;";
  addTable($params);
  // Обнуляем автоинкременты...
  $params = "ALTER TABLE `users`
    MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;";
  addTable($params);
  $params = "ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);";
  addTable($params);
  $params = "ALTER TABLE `messages`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;";
  addTable($params);
  // Обнуляем автоинкременты...
  header("Location: /");
}