<?php if ($posts):?>
	<?php foreach($posts as $post):?>
		<div class="post">
			<div class="post-title">
				<div class="post-date">
					<br>
					<img class="post-date-img" src="/img/<?=$img?>" alt="">
				</div>			
				<h2><?=$post['title'];?></h2>
			</div>
			<div class="post-entry">
			<a href="post/?id=<?=$post['id']?>"  title="Просмотр всего произведения"><img class="post-entry-img" src="/img/<?php echo ($post['image']) ?: 'null.jpeg';?>" alt="<?php echo ($post['image']) ?: 'null.jpeg';?>" hspace="4" align="left" class="float-left" <img src="/img/<?=$img?>" alt="<?=$img?>"></a>
				<?php $text = explode("\r\n", $post['text']); echo $text[0]."<br>".$text[1]."<br>".$text[2]."<br>".$text[3];?><br>
			</div>
			<div class="post-info">
				<a href="post/?id=<?=$post['id']?>"  title="Просмотр всего произведения">Читать далее...(<?=$post['reading'];?>)</a>
			</div>
			<div class="clear"></div>
		</div>
	<?php endforeach;?>
	<?php if(abs(++$_GET['page']) <= $pMax):?>
	<div class="navigation">
		<?php if(abs($_GET['page']) > 1):?>
		<div class="navigation-previous"><a href="/?page=<?=(abs($_GET['page'])-2);?>">Назад</a></div>
		<?php endif;?>
		<div class="navigation-next"><a href="/?page=<?=abs($_GET['page']);?>">Далее</a></div>
    </div>
	<?php elseif ($pMax != "0" ):?>
	<div class="navigation">
		<div class="navigation-previous"><a href="/?page=<?=(abs($_GET['page'])-2);?>">Назад</a></div>
    </div>
	<?php endif;?>
<?php else:?>
	<div class="post">
		<div class="post-title">
			<div class="post-date">
				<br>
				<img class="post-date-img" src="/img/<?=$img?>" alt="<?=$img?>">
			</div>			
			<h2>Нет записей</h2>
		</div>
		<div class="post-entry">
			<img class="post-entry-img" src="/img/<?php echo ($post['image']) ?: 'null.jpeg';?>" alt="<?php echo ($post['image']) ?: 'null.jpeg';?>" hspace="4" align="left" class="float-left">
			<p>Только что поставили движочек...</p>
		</div>
		<div class="post-info">
			<p>Авторизуйтесь и <a href="/admin">наполните БД записями!</a></p>
		</div>
		<div class="clear"></div>
	</div>
<?php endif;?>