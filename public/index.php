<?php
// Функционал загрузки картинок: (Дописал проверку расширения файла + переименование)
if ($_FILES && $_FILES["userfile"]["error"]== UPLOAD_ERR_OK)
{
    // Получим расширение файла:
    $ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
    // Проверим, картинка ли это:
    if ($ext == "png" || $ext == "jpeg" || $ext == "gif" || $ext == "jpg" || $ext == "bmp"){
        // Переименуем файл и загрузим к картинкам.
        function renDownAvatar($ext){
            // Генерим случайное имя:
            $avatar = substr(md5(time()), 0, 16).".".$ext;
            // Если его нет, то пишем так:
            if (!file_exists("img/{$avatar}")){
                move_uploaded_file($_FILES["userfile"]["tmp_name"], 'img/'. $avatar);
            } else {
                // Иначе, ну а вдруг, перезапустим гену снова:
                renDownAvatar($ext);
            }
            // Отдадим поле в код:
            return $avatar;
        }
        // Отдадим имя файла дальше в код.
        $avatar = renDownAvatar($ext);
    }
}
// Подключаем роутер:
include '../router/router.php';