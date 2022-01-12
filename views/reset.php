
<?php if ($_SESSION['login'] != ""):?>
	<meta http-equiv="refresh" content="0, url=/admin/" />
<?php endif;?>
<?php if ($_GET['resetPassword'] == "" || $_GET['resetPassword'] == "1"):?>
	<div class="post">
		<div class="post-title">
			<div class="post-date">
				<br>
				<p style="text-align: center;">сброс</p>
			</div>			
			<h2>Восстановите мне пароль:</h2>
		</div>
		<div class="post-entry">
			<form action="/reset/?resetPassword=1" method="post" enctype="multipart/form-data">
				<label for="login"><b>Логин:</b></label>
				<input type="text" placeholder="Введите логин" name="login" required><br>
				<button type="submit">Сбросить пароль</button>
				<button type="reset" class="cancelbtn">Очистить</button>
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
				<p style="text-align: center;">сброс</p>
			</div>			
			<h2>Введите новый пароль:</h2>
		</div>
		<div class="post-entry">
			<form action="/reset/?resetPassword=<?=$_GET['resetPassword']?>" method="post" enctype="multipart/form-data">
				<label for="login"><b>Новый пароль:</b></label>
				<input type="password" placeholder="Введите пароль" name="password" required><br>
				<button type="submit">Установить пароль!</button>
				<button type="reset" class="cancelbtn">Отменить сие дело!</button>
			</form>
		</div>
		<div class="post-info">
			<p>Пароль будет сброшен...</p>
		</div>
		<div class="clear"></div>
	</div>
<?php endif;?>