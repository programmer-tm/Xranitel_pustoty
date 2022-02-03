
<?php if ($_SESSION['login'] != ""):?>
	<meta http-equiv="refresh" content="0, url=/admin/" />
<?php endif;?>
<?php if ($_GET['resetPassword'] == "" || $_GET['resetPassword'] == "1"):?>
	<div class="post">
		<div class="post-title">
			<div class="post-date">
				<br>
				<p><center>сброс</center></p>
			</div>			
			<h2>Восстановите мне пароль:</h2>
		</div>
		<div class="post-entry">
			<form action="/reset/?resetPassword=1" method="post" enctype="multipart/form-data">
				<input class="form_in_reg" type="text" placeholder="Введите логин" name="login" required><br>
				<center><button type="submit">Сбросить пароль</button> <button type="reset" class="cancelbtn">Очистить</button></center>
			</form>
		</div>
		<div class="post-info">
			<p>Забыл паролик?!</p>
		</div>
		<div class="clear"></div>
	</div>
<?php else:?>
	<div class="post">
		<div class="post-title">
			<div class="post-date">
				<br>
				<p><center>сброс</center></p>
			</div>			
			<h2>Введите новый пароль:</h2>
		</div>
		<div class="post-entry">
			<form action="/reset/?resetPassword=<?=$_GET['resetPassword']?>" method="post" enctype="multipart/form-data">
				<input class="form_in_reg" type="password" placeholder="Введите новый пароль" name="password" required><br>
				<center><button type="submit">Установить пароль!</button>
				<button type="reset" class="cancelbtn">Отменить сие дело!</button><center>
			</form>
		</div>
		<div class="post-info">
			<p>Пароль будет сброшен...</p>
		</div>
		<div class="clear"></div>
	</div>
<?php endif;?>