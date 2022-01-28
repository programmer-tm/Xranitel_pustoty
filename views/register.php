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
				<input style="width: 540px; margin-bottom: 4px;" type="text" placeholder="Введите логин" name="nickname" required><br>
				<input style="width: 540px; margin-bottom: 4px;" type="text" placeholder="Введите имя" name="name" required><br>
				<input style="width: 540px; margin-bottom: 4px;" type="text" placeholder="Введите фамилию" name="surname" required><br>
				<input style="width: 540px; margin-bottom: 4px;" type="email" placeholder="Введите email" name="email" required><br>
				<input style="width: 540px; margin-bottom: 4px;" type="password" placeholder="Введите пароль" name="password" required><br>
				<input style="width: 540px; margin-bottom: 4px;" type="password" placeholder="Введите пароль" name="password2" required><br>
				<center><button type="submit">Регистрировать меня!</button> <button type="reset" class="cancelbtn">Отменить всё!</button></center>
		</form>
	</div>
	<div class="post-info">   
	</div>
	<div class="clear"></div>
</div>