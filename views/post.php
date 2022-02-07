<div class="post">
	<div class="post-title">
		<div class="post-date">
			<br>
			<img class="post-date-img" src="/img/<?=$img?>" alt="<?=$img?>">
		</div>			
		<h2><?=$post['title'];?></h2>
	</div>
	<div class="post-entry">
		<img class="post-entry-img-big" src="/img/<?php echo ($post['image']) ?: 'null.jpeg';?>"><br>
		<?php echo str_replace(array("\r\n", "\r", "\n"), '<br>', $post['text']);?>
	</div>
	<div class="post-info">
		Это интересно?
	</div>
	<div class="clear"></div>
</div>
<?php if ($commentCount == 0):?>
	<div class="post">
		<div class="post-title">
			<div class="post-date">
				<br>
				<img class="post-date-img" src="/img/null.jpeg" alt="null.jpeg">
			</div>			
			<h2>Комментарий:</h2>
		</div>
		<div class="post-entry">
			А их нет...
		</div>
		<div class="post-info">
		</div>
		<div class="clear"></div>
	</div>
<?php else:?>
	<!-- Тут блок обхода комментариев, если они есть -->
	<?php foreach($comments as $comment):?>
		<div class="post">
		<div class="post-title">
			<div class="post-date">
				<br>
				<img class="post-date-img" src="/img/<?php echo ($comment['avatar']) ?: 'null.jpeg';?>" alt="<?php echo ($comment['avatar']) ?: 'null.jpeg';?>">
			</div>			
			<h2><?=$comment['name'];?>:</h2>
		</div>
		<div class="post-entry">
			<?=$comment['text'];?>
		</div>
		<div class="post-info">
		</div>
		<div class="clear"></div>
	</div>
	<?php endforeach;?>
<?php endif;?>
<!-- Форма отправки коммента, в зависимости от авторизации -->
<div class="post">
<div class="comments">
	<h2>Форма отправки комментариев:</h2><br>
	<form action="/post/?id=<?=$post['id'];?>" method="post" enctype="multipart/form-data">
		<?php if (!$_SESSION['login']):?>
			<input class="form_in_otz_p" type="text" placeholder="Введите имя" name="name" required><br>
			<input class="form_in_otz_p" type="email" size = 25 placeholder="Введите email" name="email" required><br>
		<?php endif;?>
            <textarea class="form_in_otz_p_b" placeholder="Введите текст комментария" name="text" required></textarea><br>
            <center><button type="submit">Отправить</button>
            <button type="reset" class="cancelbtn">Очистить</button></center>
	</form>
	<div class="clear"></div>
</div>
</div>