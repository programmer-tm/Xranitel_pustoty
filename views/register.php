<?php if ($_SESSION['login'] != ""):?>
	<meta http-equiv="refresh" content="0, url=/admin/" />
<?php endif;?>
<div class="post">
	<div class="post-title">
		<div class="post-date">
			<br>
			<p style="text-align: center;">***</p>
		</div>			
	    <h2>Регистрация:</h2>
	</div>
	<div class="post-entry">
	<form action="/register/?reg=1" method="post" enctype="multipart/form-data">
				<label for="nickname"><b>Логин:</b></label>
				<input type="text" placeholder="Введите логин" name="nickname" required><br>
				<label for="name"><b>Имя:</b></label>
				<input type="text" placeholder="Введите имя" size = 22 name="name" required><br>
				<label for="surname"><b>Фамилия:</b></label>
				<input type="text" placeholder="Введите фамилию" size = 17 name="surname" required><br>
				<label for="email"><b>Email:</b></label>
				<input type="email" placeholder="Введите email" size = 21 name="email" required><br>
				<label for="password"><b>Пароль:</b></label>
				<input type="password" placeholder="Введите пароль" size = 19 name="password" required><br>
				<label for="password"><b>Повтор пароля:</b></label>
				<input type="password" placeholder="Введите пароль" size = 11 name="password2" required><br>
				<button type="submit">Регистрировать меня!</button>
				<button type="reset" class="cancelbtn">Отменить всё!</button>
		</form>
	</div>
	<div class="post-info">   
	</div>
	<div class="clear"></div>
</div>