<div class="post">
	<div class="post-title">
		<div class="post-date">
			<br>
			<p class="post-date-title">user</p>
		</div>			
		<h2>Поправить личные данные:</h2>
	</div>
	<div class="post-entry">
        <form action="/admin/?edit=1" method="post" enctype="multipart/form-data">
            <table border="1" width="98%" bordercolor="black">
                <tr>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Статус</th>
                </tr>
                <tr>
                    <input type="text" name="user_id" value="<?=$user['id']?>" hidden>
                    <td class="td_3"><input class="t_c_97" type="text" name="name" value="<?=$user['name'];?>"></td>
                    <td class="td_3"><input class="t_c_95" type="text" name="surname" value="<?=$user['surname'];?>"></td>
                    <?php if ($user['status'] == 1):?>
                    <td class="td_3"><center>Модератор</center></td>
                    <?php elseif ($user['status'] == 2):?>
                    <td class="td_3"><center>Пользователь</center></td>
                    <?php endif;?>
                </tr>
                <tr>
                    <th>Аватар</th>
                    <th>Пароль</th>
                    <th>Взаимодействие</th>
                </tr>
                <tr>
					<td class="td_3"><center><img class="post-entry-img-avatar" src="/img/<?php echo ($user['avatar']) ?: 'null.jpeg';?>" alt="<?=$user["nickname"];?>"><input accept=".jpg, .jpeg, .png, .gif, .bmp" name="userfile" type="file" />
					<?php if ($user["avatar"] != ""):?>
                    <br><input type="button" onclick="if(confirm('Удалить аватарку?!\nЭта операция не обратима!')){document.location.href = '/admin/?killAvatar=<?php echo $user['id'];?>';};" value="Удалить Аватар"/>
                    <?php endif;?></center></td>
                    <td class="td_3"><input class="t_c_95" type="text" name="password" value="***"></td>
                    <td class="td_3"><center><button type="submit">Сохранить</button><br><input type="button" onclick="if(confirm('Убить тебя об стенку?!\nЭта операция не обратима!')){document.location.href = '/admin/?kill=<?php echo $user['id'];?>';};" value="Удалить профиль"/><center></td>
                </tr>
	        </table>
        </form>
	</div>
	<div class="post-info">
		<p>Все поправил?</p>
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
            <table border="1" width="98%" bordercolor="black">
				<tr>
					<th class="td_6">Комментарий к посту</th>
					<th class="td_6">Логин на сайте</th>
					<th class="td_6">Кто оставил</th>
					<th class="td_6">Текст комментария</th>
	    			<th class="td_6">Изменить статус</th>
					<th class="td_6">Взаимодействие</th>
				</tr>
				<?php foreach($commentList as $list):?>
				<form action="/admin/?edit=2" method="post" enctype="multipart/form-data">
				<tr>
					<input type="text" name="post_id" value="<?=$list['id']?>" hidden>
					<?php if ($list['title']):?>
					<td class="td_6"><center><?=$list['title'];?></center></td>
					<?php else:?>
					<td class="td_6"><center>Отзыв о сайте</center></td>
					<?php endif;?>
					<?php if (!is_null($list['nickname'])):?>
					<td class="td_6"><center><?=$list['nickname'];?></center></td>
					<?php else:?>
					<td class="td_6"><center>Не зарегистрирован</center></td>
					<?php endif;?>
					<td class="td_6"><input class="t_c_89" type="text" name="name" value="<?=$list['name']?>"></td>
					<td class="td_6"><input class="t_c_92" type="text" name="text" value="<?=$list['text']?>"></td>
					<?php if($list['status'] == 0):?>
					<td class="td_6"><a href="/admin/?mod=<?=$list['id'];?>"><center>Опубликовать</center></a></td>
					<?php elseif($list['status'] == 1):?>
					<td class="td_6"><a href="/admin/?mod=<?=$list['id'];?>"><center>Снять с публикации</center></a></td>
					<?php else:?>
					<td class="td_6"><a href="/admin/?mod=<?=$list['id'];?>"><center>Восстановить</center></a></td>
					<?php endif;?>
					<td class="td_6"><center><button type="submit">Сохранить</button><br><a href="/admin/?delete=<?=$list['id'];?>">Удалить</a></center></td>
				</form>
				</tr>
				<?php endforeach;?>
			</table>
		<?php else:?>
			Нет комментариев, вот прям совсем нет :-)
		<?php endif;?>
	</div>
	<div class="post-info">
        <p>И на это наши полномочия все...</p>
	</div>
	<div class="clear"></div>
</div>