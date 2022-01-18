<?php if($_SESSION['login']):?>
	<div class="post">
	<div class="post-title">
		<div class="post-date">
			<br>
			<p class="post-date-title">user</p>
		</div>			
		<h2>Управление пользователями:</h2>
	</div>
	<div class="post-entry">
	<?php foreach ($userList as $user):?>
	<table border="1" width="98%" bordercolor="black">
<form action="/admin/?edit=1" method="post" enctype="multipart/form-data">
<tr>
	<th>Логин</th>
	<th>Имя</th>
	<th>Фамилия</th>
	
<tr>
	<input type="text" name="user_id" value="<?=$user['id']?>" hidden>
	<td><?=$user['nickname'];?></td>
	<td><input type="text" name="name" value="<?=$user['name'];?>"></td>
	<td><input type="text" size="9" name="surname" value="<?=$user['surname'];?>"></td>
	
</tr>
<tr>
	<th>Почта</th>
	<th>Статус</th>
	<th>Взаимодействие</th>
</tr>
<tr>
	<td><?=$user['email'];?></td>
	<?php if ($user['status'] == 1):?>
	<td><a href="/admin/?userMod=<?=$user['id'];?>">Модератор</a></td>
	<?php elseif ($user['status'] == 2):?>
	<td><a href="/admin/?userMod=<?=$user['id'];?>">Пользователь</a></td>
	<?php elseif ($user['status'] == 0):?>
	<td><a href="/admin/?userMod=<?=$user['id'];?>">Администратор</a></td>
	<?php endif;?>
	<td rowspan="3"><button type="submit">Сохранить</button><br><a href="/admin/?kill=<?=$user['id'];?>">Удалить</a></td>
</tr>
<tr>
	<th>Аватар</th>
	<th>Пароль</th>
</tr>
	<td><img class="post-entry-img-avatar" loading="auto" src="/img/<?php echo ($user['avatar']) ?: 'null.jpeg';?>" alt="<?=$user["nickname"];?>"><input accept=".jpg, .jpeg, .png, .gif, .bmp" name="userfile" type="file" />
	<?php if ($user["avatar"] != ""):?>
    <br><input type="button" onclick="if(confirm('Удалить аватарку?!\nЭта операция не обратима!')){document.location.href = '/admin/?killAvatar=<?php echo $user['id'];?>';};" value="Удалить Аватар"/>
    <?php endif;?></td>
	<td><input type="text" name="password" value="***"></td>
</tr>
</form>
</table><br>
<?php endforeach;?>
	</div>
	<div class="post-info">
		<p>Управление пользователями и их статусами...</p>
	</div>
	<div class="clear"></div>
</div>

<div class="post">
	<div class="post-title">
		<div class="post-date">
			<br>
			<p class="post-date-title">post</p>
		</div>			
		<h2>Управление записями:</h2>
	</div>
	<div class="post-entry">
	<table border="1" width="98%">
		<form action="?addPost=1" method="post" enctype="multipart/form-data">
		<tr>
			<th>Изображение</th>
			<th>Заголовок</th>
		</tr>
		<tr>
			<td><img class="post-entry-img-post" loading="auto" src="/img/null.jpeg"><input accept=".jpg, .jpeg, .png, .gif, .bmp" name="userfile" type="file" /></td>
			<td><input type="text" name="postTitle" placeholder="Заголовок"></td>
		</tr>
		<tr>
			<th>Текст</th>
			<th>Взаимодействие</th>
		<tr>
		<tr>				
			<td><textarea rows="19" name="postText" rows="19" cols="44"><?=$string['text']?></textarea></td>
			<td><button type="submit"> Опубликовать запись</button></td>
		</tr>
		</form>
	</table><br>
	<?php foreach($postList as $string):?>
	<form action="/admin/?edit=3" method="post" enctype="multipart/form-data">
	<table border="1" width="98%">
		<tr>
			<th>Изображение</th>
			<th>Заголовок</th>
			<th>Взаимодействие</th>
		</tr>
		<tr>
			<input type="text" name="postId" value="<?=$string['id']?>" hidden>
			<td><img class="post-entry-img-post" src="/img/<?php echo ($string['image']) ?: 'null.jpeg';?>"><input accept=".jpg, .jpeg, .png, .gif, .bmp" name="userfile" type="file" /><br><a href="/admin/?killImg=<?=$string['id']?>">Удалить изображение</a></td>
			<td><input type="text" name="postTitle" value="<?=$string['title']?>"></td>
			<td rowspan="4"><button type="submit">Сохранить</button><br><a href="/admin/?deletePost=<?=$string['id']?>">Удалить</a></td>
		</tr>
		<tr>
			<th>Текст</th>
			<th>Количество прочтений</th>
		<tr>
		<tr>				
			<td><textarea rows="19" name="postText" rows="19" cols="31"><?=$string['text']?></textarea></td>
			<td><?=$string['reading']?> | <a href="/admin/?kill=<?=$string['id']?>">Сброс</a></td>
		</tr>
		</form>
		</table><br>
		<?php endforeach;?>
	</div>
	<div class="post-info">
		<p>Управление и добавление записей...</p>
	</div>
	<div class="clear"></div>
</div>
<div class="post">
	<div class="post-title">
		<div class="post-date">
			<p class="post-date-title">com-<br>ment</p>
		</div>			
		<h2>Управление комментариями:</h2>
	</div>
	<div class="post-entry">
	<?php if ($commentList):?>
		<?php foreach($commentList as $list):?>
		<form action="/admin/?edit=2" method="post" enctype="multipart/form-data">
		<table border="1" width="98%">
			<tr>
				<th>Комментарий к посту</th>
				<th>Кто оставил</th>
				<th>Email</th>
				<th>Текст комментария</th>
			<tr>
				<input type="text" name="post_id" value="<?=$list['id']?>" hidden>
				<?php if ($list['title']):?>
				<td><?=$list['title'];?></td>
				<?php else:?>
				<td>Отзыв о сайте</td>
				<?php endif;?>
				<td><input type="text" name="name" value="<?=$list['name']?>"></td>
				<td><?=$list['email'];?></td>
				<td><input type="text" name="text" value="<?=$list['text']?>"></td>
			</tr>
			<tr>
				<th>Логин на сайте</th>
				<th>Кто разрешил</th>
				<th>Изменить статус</th>
				<th>Взаимодействие</th>
			</tr>
			<tr>
				<?php if (!is_null($list['nickname'])):?>
				<td><?=$list['nickname'];?></td>
				<?php else:?>
				<td>Не зарегистрирован</td>
				<?php endif;?>
				<?php if (!is_null($list['moder'])):?>
				<td><?=$list['moder'];?></td>
				<?php else:?>
				<td>-</td>
				<?php endif;?>
				<?php if($list['status'] == 0):?>
				<td><a href="/admin/?mod=<?=$list['id'];?>">Опубликовать</a></td>
				<?php elseif($list['status'] == 1):?>
				<td><a href="/admin/?mod=<?=$list['id'];?>">Снять с публикации</a></td>
				<?php else:?>
				<td><a href="/admin/?mod=<?=$list['id'];?>">Восстановить</a></td>
				<?php endif;?>
				<td><button type="submit">Сохранить</button> | <a href="/admin/?delete=<?=$list['id'];?>">Удалить</a></td>
			</tr>
		</table><br>
		</form>
		<?php endforeach;?>
		<?php else:?>
			<p>Нет комментариев, вот прям совсем нет :-)</p>
		<?php endif;?>
	</div>
	<div class="post-info">
		<p>Управление комментариями...</p>
	</div>
	<div class="clear"></div>
</div>
<?php else:?>
	<meta http-equiv="refresh" content="0, url=/" />
<?php endif;?>