<!--Объявили сайт, как таковой:-->
<!DOCTYPE html>
<!--Язык портала:-->
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Данные для поисковиков: (Тут каждый прописывает то, что нужно именно в его случае)-->
    <meta name="keywords" content="Сергей, Минеев, стихи, Бредни писателя, Хранитель пустоты, Сайт стихов Сергея Минеева">
    <meta name="description" content="Сергей, Минеев, стихи, Бредни писателя, Хранитель пустоты, Сайт стихов Сергея Минеева">
    <!--Заголовочная часть-->
    <!-- Тут выводим название проекта из конфига, информационнное сообщение -->
	<?php if ($message == "error" || $controller == 'logout'):?>
		<meta http-equiv="refresh" content="0; url=/" />
	<?php else:?>
		<title><?=$title?> : <?=$page;?></title>
		<script>
			var message="<?=$_SESSION['message'];?>";
			if (message){
				alert(message);
			}
			<?php unset($_SESSION["message"]);?>
		</script>	
	<?php endif;?>
	<!--Иконка портала:-->
    <link rel="icon" href="/images/1.ico" type="image/x-icon">
	<!--Подключаем табличку стилей:-->
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Marck+Script&display=swap" rel="stylesheet">
</head>
<body>
	<!--Проверка сообщения для вывода или не в
	вывода информации:-->
	<?php if ($message != "error" || $controller == 'logout'):?>
	<div id="page">
	<div id="page-top">
	<div id="page-bottom">
	<div id="header">
	<!--Заголовок страницы:-->
	<div id="header-info">
		<h1><a href="/"><?=$title;?></a></h1>
		<div class="description"><?=$page;?></div>
	</div>
	<!--Навигационная система проекта-->
	<div id="header-menu">
		<ul>
			<li><a href="/">Главная</a></li>
			<?php if($_SESSION['id']):?>
			<li><a href="/messages/">Личные сообщения</a></li>
			<li><a href="/admin/">Личный кабинет</a></li>
			<?php endif;?>
			<li><a href="/downloads/books.pdf.zip">Архив книг</a></li>
		</ul>
	</div>
	<!-- Подписки на новости не используются (Картинка вырезана из проекта)
	<div id="header-feed">
		<a href="rss.xml"><img src="/images/blank.gif" alt="RSS Feed" width="125" height="50" /></a>
	</div>-->
	</div>
	<div id="main">
	<div id="sidebar">
	<!-- Это блоки навигации -->
	<div class="sidebar-box">
	<div class="sidebar-box-top"></div>
	<div class="sidebar-box-in">
		<h3>Твой мир:</h3>
		<h4><?=$menu;?></H4>
	</div>
	<div class="sidebar-box-bottom"></div>
	</div>
	<!-- Это блоки навигации -->
	<div class="sidebar-box">
	<div class="sidebar-box-top"></div>
	<div class="sidebar-box-in">
		<h3>Полезные ссылки:</h3>
		<ul>
		<?php foreach($links as $title => $link):?>
			<li><a href="<?=$link;?>"><?=$title;?></a></li>
		<?php endforeach;?>
		</ul>
	</div>
	<div class="sidebar-box-bottom"></div>
	</div>
	<!-- Это блоки навигации -->
	<!-- Это блоки навигации -->
	<h2 class="zagl_otziv">Отзывы о сайте:</h2>
	<?php if($commentsSite):?>
	<?php foreach($commentsSite as $comment):?>
	<div class="sidebar-box">
	<div class="sidebar-box-top"></div>
	<div class="sidebar-box-in">
		<h3><img class="sidebar-box-in-img" src="/img/<?php echo ($comment['avatar']) ?: 'null.jpeg';?>" alt="<?php echo ($comment['avatar']) ?: 'null.jpeg';?>" align="left" hspace="2"><?=$comment['name']?>(о сайте):</h3>
		<h4><?=$comment['text']?></h4>
	</div>
	<div class="sidebar-box-bottom"></div>
	</div>
	<?php endforeach;?>
	<?php else:?>
		<div class="sidebar-box">
		<div class="sidebar-box-top"></div>
		<div class="sidebar-box-in">
			<h3>О сайте:</h3>
			<h4>Пока никто не писал...</h4>
		</div>
		<div class="sidebar-box-bottom"></div>
		</div>
	<?php endif;?>
	<!-- Это блоки навигации -->
	<div class="sidebar-box-blank">
		<h3>Оставить отзыв о сайте:</h3>
		<form action="/post/?id=0" method="post" enctype="multipart/form-data">
		<?php if (!$_SESSION['login']):?>
			<input class="form_otziv" type="text" placeholder="Введите имя" name="name" required><br>
			<input class="form_otziv" type="email" placeholder="Введите email" name="email" required><br>
		<?php endif;?>
			<textarea class="form_otziv" placeholder="Введите текст комментария" name="text" required></textarea><br>
			<button type="submit">Отправить</button>
			<button type="reset" class="cancelbtn">Очистить</button>
		</form>
	</div>
	<!-- Это блоки навигации -->
	</div>
	<!--Контент сайта:-->
	<div id="content">
	<!--Тут основной контент сайта-->
		<?=$body;?>
	<div class="clear"></div>
		</div>
	<div class="clear"></div>
	</div>
	<!--Подвал сайта с копирайтом-->
	<div id="footer">
	&copy; Programmer-tm
	</div>
	</div></div></div>
	<?php endif;?>
</body>
</html>