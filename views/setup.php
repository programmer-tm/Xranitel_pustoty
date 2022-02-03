<?php if ($_SESSION['login'] != ""):?>
	<meta http-equiv="refresh" content="0, url=/admin/" />
<?php endif;?>
<?php if (!$db):?>
<div class="post">
	<div class="post-title">
		<div class="post-date">
			<br>
			<p><center>base</center></p>
		</div>			
		<h2>Введите информацию о проекте:</h2>
	</div>
	<div class="post-entry">
		<form action="/setup/?done=0" method="post" enctype="multipart/form-data">
			<input class="form_in_reg" type="text" value="<?=$config['title'];?>" name="title" required><br>
			<input class="form_in_reg" type="text" value="<?=$config['mysql']?>" name="mysql" required><br>
			<input class="form_in_reg" type="text" value="<?=$config['port']?>" name="port" required><br>
			<input class="form_in_reg" type="text" value="<?=$config['login']?>" name="login" required><br>
			<input class="form_in_reg" type="password" value="<?=$config['password']?>" name="password" required><br>
			<input class="form_in_reg" type="text" value="<?=$config['bd']?>" name="bd" required><br>
			<input class="form_in_reg" type="number" value="<?=$config['pCount']?>" name="pCount" required><br>
			<input class="form_in_reg" type="number" value="<?=$config['mCount']?>" name="mCount" required><br>
			<center><button type="submit">Установить!</button></center>
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
			<p><center>admin<center></p>
		</div>			
		<h2>Администартор:</h2>
	</div>
	<div class="post-entry">
		<form action="/setup/?done=1" method="post" enctype="multipart/form-data">
			<input class="form_in_reg" type="text" placeholder="Введите логин" name="nickname" required><br>
			<input class="form_in_reg" type="text" placeholder="Введите имя" name="name" required><br>
			<input class="form_in_reg" type="text" placeholder="Введите фамилию" name="surname" required><br>
			<input class="form_in_reg" type="email" placeholder="Введите email" name="email" required><br>
			<input class="form_in_reg" type="password" placeholder="Введите пароль" name="password" required><br>
			<center><button type="submit">Установить!</button> <button type="reset" class="cancelbtn">Отменить всё!</button></center>
		</form>
	</div>
	<div class="post-info">
	<p>Внимание, движок установится на хостинг!</p>
	</div>
	<div class="clear"></div>
</div>