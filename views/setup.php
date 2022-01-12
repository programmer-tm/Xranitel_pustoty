<?php if ($_SESSION['login'] != ""):?>
	<meta http-equiv="refresh" content="0, url=/admin/" />
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
			<button type="reset" class="cancelbtn">Отменить всё!</button><br><br>
		</form>
	</div>
	<div class="post-info">
	<p>Внимание, движок установится на хостинг!</p>
	</div>
	<div class="clear"></div>
</div>