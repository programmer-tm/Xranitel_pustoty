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
	<th class="td_3">Логин</th>
	<th class="td_3">Имя</th>
	<th class="td_3">Фамилия</th>
	
<tr>
	<input type="text" name="user_id" value="<?=$user['id']?>" hidden>
	<td class="td_3"><center><?=$user['nickname'];?></center></td>
	<td class="td_3"><input class="t_c_94" type="text" name="name" value="<?=$user['name'];?>"></td>
	<td class="td_3"><input class="t_c_94" type="text" size="9" name="surname" value="<?=$user['surname'];?>"></td>
	
</tr>
<tr>
	<th class="td_3">Почта</th>
	<th class="td_3">Статус</th>
	<th class="td_3">Взаимодействие</th>
</tr>
<tr>
	<td class="td_3"><center><?=$user['email'];?></center></td>
	<?php if ($user['status'] == 1):?>
	<td class="td_3"><a href="/admin/?userMod=<?=$user['id'];?>"><center>Модератор</center></a></td>
	<?php elseif ($user['status'] == 2):?>
	<td class="td_3"><a href="/admin/?userMod=<?=$user['id'];?>"><center>Пользователь</center></a></td>
	<?php elseif ($user['status'] == 0):?>
	<td class="td_3"><a href="/admin/?userMod=<?=$user['id'];?>"><center>Администратор</center></a></td>
	<?php endif;?>
	<td class="td_3" rowspan="3"><center><button type="submit">Сохранить</button><br><a href="/admin/?kill=<?=$user['id'];?>">Удалить</a></center></td>
</tr>
<tr>
	<th class="td_3">Аватар</th>
	<th class="td_3">Пароль</th>
</tr>
	<td class="td_3"><center><img class="post-entry-img-avatar" loading="auto" src="/img/<?php echo ($user['avatar']) ?: 'null.jpeg';?>" alt="<?=$user["nickname"];?>"><input accept=".jpg, .jpeg, .png, .gif, .bmp" name="userfile" type="file" />
	<?php if ($user["avatar"] != ""):?>
    <br><input type="button" onclick="if(confirm('Удалить аватарку?!\nЭта операция не обратима!')){document.location.href = '/admin/?killAvatar=<?php echo $user['id'];?>';};" value="Удалить Аватар"/>
    <?php endif;?></center></td>
	<td class="td_3"><input class="t_c_94" type="text" name="password" value="***"></td>
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
			<th class="td_2">Изображение</th>
			<th class="td_2">Заголовок</th>
		</tr>
		<tr>
			<td class="td_2"><center><img class="post-entry-img-post" loading="auto" src="/img/null.jpeg"><input accept=".jpg, .jpeg, .png, .gif, .bmp" name="userfile" type="file" /></center></td>
			<td class="td_2"><input class="t_c_97" type="text" name="postTitle" placeholder="Заголовок"></td>
		</tr>
		<tr>
			<th class="td_2">Текст</th>
			<th class="td_2">Взаимодействие</th>
		<tr>
		<tr>				
			<td class="td_2"><textarea class="t_c_98" name="postText" rows="19" cols="44"><?=$string['text']?></textarea></td>
			<td class="td_2"><center><button type="submit">Опубликовать запись</button></center></td>
		</tr>
		</form>
	</table><br>
	<?php foreach($postList as $string):?>
	<form action="/admin/?edit=3" method="post" enctype="multipart/form-data">
	<table border="1" width="98%">
		<tr>
			<th class="td_3">Изображение</th>
			<th class="td_3">Заголовок</th>
			<th class="td_3">Взаимодействие</th>
		</tr>
		<tr>
			<input type="text" name="postId" value="<?=$string['id']?>" hidden>
			<td class="td_3"><center><img class="post-entry-img-post" src="/img/<?php echo ($string['image']) ?: 'null.jpeg';?>"><input accept=".jpg, .jpeg, .png, .gif, .bmp" name="userfile" type="file" /><br><a href="/admin/?killImg=<?=$string['id']?>">Удалить изображение</a></center></td>
			<td class="td_3"><input class="t_c_94" type="text" size="13" name="postTitle" value="<?=$string['title']?>"></td>
			<td class="td_3" rowspan="4"><center><button type="submit">Сохранить</button><br><a href="/admin/?deletePost=<?=$string['id']?>">Удалить</a></center></td>
		</tr>
		<tr>
			<th class="td_3">Текст</th>
			<th class="td_3">Количество прочтений</th>
		<tr>
		<tr>				
			<td class="td_3"><textarea class="t_c_98" name="postText" rows="19" cols="31"><?=$string['text']?></textarea></td>
			<td class="td_3"><center><?=$string['reading']?><br><a href="/admin/?kill=<?=$string['id']?>">Сброс</a></center></td>
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
				<th class="td_4">Комментарий к посту</th>
				<th class="td_4">Кто оставил</th>
				<th class="td_4">Email</th>
				<th class="td_4">Текст комментария</th>
			<tr>
				<input type="text" name="post_id" value="<?=$list['id']?>" hidden>
				<?php if ($list['title']):?>
				<td class="td_4"><center><?=$list['title'];?></center></td>
				<?php else:?>
				<td class="td_4"><center>Отзыв о сайте</center></td>
				<?php endif;?>
				<td class="td_4"><input class="t_c_94" type="text" name="name" value="<?=$list['name']?>"></td>
				<td class="td_4"><center><?=$list['email'];?></center></td>
				<td class="td_4"><input class="t_c_94" type="text" name="text" value="<?=$list['text']?>"></td>
			</tr>
			<tr>
				<th class="td_4">Логин на сайте</th>
				<th class="td_4">Кто разрешил</th>
				<th class="td_4">Изменить статус</th>
				<th class="td_4">Взаимодействие</th>
			</tr>
			<tr>
				<?php if (!is_null($list['nickname'])):?>
				<td class="td_4"><center><?=$list['nickname'];?></center></td>
				<?php else:?>
				<td class="td_4"><center>Не зарегистрирован</center></td>
				<?php endif;?>
				<?php if (!is_null($list['moder'])):?>
				<td class="td_4"><center><?=$list['moder'];?></center></td>
				<?php else:?>
				<td class="td_4"><center>-</center></td>
				<?php endif;?>
				<?php if($list['status'] == 0):?>
				<td class="td_4"><center><a href="/admin/?mod=<?=$list['id'];?>">Опубликовать</a></center></td>
				<?php elseif($list['status'] == 1):?>
				<td class="td_4"><center><a href="/admin/?mod=<?=$list['id'];?>">Снять с публикации</a></center></td>
				<?php else:?>
				<td class="td_4"><center><a href="/admin/?mod=<?=$list['id'];?>">Восстановить</a></center></td>
				<?php endif;?>
				<td class="td_4"><center><button type="submit">Сохранить</button><br><a href="/admin/?delete=<?=$list['id'];?>">Удалить</a></center></td>
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