<?php if ($_SESSION['login'] != ""):?>
	<meta http-equiv="refresh" content="0, url=/admin/" />
<?php endif;?>
<?php if (!$db):?>
<div class="post">
	<div class="post-title">
		<div class="post-date">
			<br>
			<p style="text-align: center;">database</p>
		</div>			
		<h2>Введите информацию о проекте:</h2>
	</div>
	<div class="post-entry">
		<form action="/setup/?done=0" method="post" enctype="multipart/form-data">
			<label for="title"><b>Название:</b></label>
			<input type="text" value="<?=$config['title'];?>" name="title" required><br>
			<label for="mysql"><b>Sql сервер:</b></label>
			<input type="text" value="<?=$config['mysql']?>" name="mysql" required><br>
			<label for="port"><b>Порт сервера sql:</b></label>
			<input type="text" value="<?=$config['port']?>" name="port" required><br>
			<label for="login"><b>SQL Login:</b></label>
			<input type="password" value="<?=$config['login']?>" name="login" required><br>
			<label for="password"><b>SQL Пароль:</b></label>
			<input type="password" value="<?=$config['password']?>" name="password" required><br>
			<label for="bd"><b>SQL база:</b></label>
			<input type="text" value="<?=$config['bd']?>" name="bd" required><br>
			<label for="pCount"><b>Постов на страницу:</b></label>
			<input type="number" value="<?=$config['pCount']?>" name="pCount" required><br>
			<label for="password"><b>Максимум личных сообщений:</b></label>
			<input type="number" value="<?=$config['mCount']?>" name="mCount" required><br>
			<button type="submit">Установить!</button>
		</form>
	</div>
	<div class="post-info">
	<p>Внимание, изменения запишутся в конфиг!</p>
	</div>
	<div class="clear"></div>
</div>
<?php endif;?>


<div class="post">
	<div class="post-title">
		<div class="post-date">
			<br>
			<p style="text-align: center;">admin</p>
		</div>			
		<h2>Введите информацию об администраторе сайта:</h2>
	</div>
	<div class="post-entry">
		<form action="/setup/?done=1" method="post" enctype="multipart/form-data">
			<label for="nickname"><b>Логин:</b></label>
			<input type="text" placeholder="Введите логин" name="nickname" required><br>
			<label for="name"><b>Имя:</b></label>
			<input type="text" placeholder="Введите имя" name="name" required><br>
			<label for="surname"><b>Фамилия:</b></label>
			<input type="text" placeholder="Введите фамилию" name="surname" required><br>
			<label for="email"><b>Email:</b></label>
			<input type="email" placeholder="Введите email" name="email" required><br>
			<label for="password"><b>Пароль:</b></label>
			<input type="password" placeholder="Введите пароль" name="password" required><br>
			<button type="submit">Установить!</button>
			<button type="reset" class="cancelbtn">Отменить всё!</button>
		</form>
	</div>
	<div class="post-info">
	<p>Внимание, движок установится на хостинг!</p>
	</div>
	<div class="clear"></div>
</div>