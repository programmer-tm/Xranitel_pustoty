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
	<form action="/post/?id=<?=$post['id'];?>" method="post" enctype="multipart/form-data">
		<?php if (!$_SESSION['login']):?>
      		<label for="name"><b>Ваше имя:</b></label>
			<input type="text" size = 22 placeholder="Имя" name="name" required><br>
			<label for="email"><b>Email:</b></label>
			<input type="email" size = 25 placeholder="Email" name="email" required><br>
		<?php endif;?>
			<label for="text"><b>Комментарий:</b></label>
            <textarea placeholder="Комментарий" name="text" required></textarea><br>
            <button type="submit">Отправить</button>
            <button type="reset" class="cancelbtn">Очистить</button>
	</form>
	<div class="clear"></div>
</div>
</div>