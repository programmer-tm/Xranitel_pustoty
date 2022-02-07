<?php if ($posts):?>
	<?php foreach($posts as $post):?>
		<div class="post">
			<div class="post-title">
				<div class="post-date">
					<br>
					<img class="post-date-img"  loading="auto" src="/img/<?=$img?>" alt="">
				</div>			
				<h2><a href="post/?id=<?=$post['id']?>"  title="Просмотр всего произведения"><?=$post['title'];?></a></h2>
			</div>
			<div class="post-entry">
			<a href="post/?id=<?=$post['id']?>"  title="Просмотр всего произведения">
			<img src="/img/<?php echo ($post['image']) ?: 'null.jpeg';?>" loading="auto" class="post-entry-img" alt="<?php echo ($post['image']) ?: 'null.jpeg';?>" hspace="4" align="left" class="float-left"></a>
				<?php $text = explode("\r\n", $post['text']); echo $text[0]."<br>".$text[1]."<br>".$text[2]."<br>".$text[3];?><br>
			</div>
			<div class="post-info">
				<a href="post/?id=<?=$post['id']?>"  title="Просмотр всего произведения">Читать далее...(<?=$post['reading'];?>)</a>
			</div>
			<div class="clear"></div>
		</div>
	<?php endforeach;?>
	<?php if(($pT=abs($_GET['page'])) <= $pMax):?>
	<?php $pN = $pT + 1; $pP = $pT - 1;?>
	<div class="navigation">
		<?php if($pP == 0):?>
		<div class="navigation-previous"><a href="/">Назад</a></div>
		<div class="navigation-next"><a href="/?page=<?=$pN;?>">Далее</a></div>
		<?php elseif($pN > $pMax):?>
		<div class="navigation-previous"><a href="/?page<?=$pP;?>">Назад</a></div>
		<?php elseif($pT != 0):?>
		<div class="navigation-previous"><a href="/?page=<?=$pP;?>">Назад</a></div>
		<div class="navigation-next"><a href="/?page=<?=$pN;?>">Далее</a></div>
		<?php elseif ($pT == 0):?>
		<div class="navigation-next"><a href="/?page=<?=$pN;?>">Далее</a></div>
		<?php endif;?>
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
