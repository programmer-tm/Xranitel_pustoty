<?php if($_SESSION['id']):?>
<div class="post">
	<div class="post-title">
		<div class="post-date">
			<br>
			<p class="post-date-title">До Вас</p>
		</div>			
		<h2>Входящие сообщения:</h2>
	</div>
	<div class="post-entry">
        <?php if($messagesTo):?>
        <table border="1" width="98%" bordercolor="black">
            <tr>
                <th>От кого</th>
                <th>Сообщение</th>
                <th>Дата</th>
                <th>Прочитано</th>
                <th>Взаимодействие</th>
            </tr>
            <?php foreach($messagesTo as $messageTo):?>
            <tr>
                <td><center><?=$messageTo['from'];?></center></td>
                <td><center><?=$messageTo['message'];?></center></td>
                <td><center><?=$messageTo['date_message'];?></center></td>
                <?php if ($messageTo['date_read']):?>
                <td><center><?=$messageTo['date_read'];?></center></td>
                <?php else:?>
                <td><center><b>NEW</b></center></td>
                <?php endif;?>
                <td><center><a href="/messages/?delete=<?=$messageTo['id'];?>">Удалить</a><br><?php if (!$messageTo['date_read']):?><a href="/messages/?read=<?=$messageTo['id'];?>">Прочитать</a><?php endif;?></center></td>
            </tr>
            <?php endforeach;?>
        </table>
        <?php else:?>
            <p>Сообщений нет</p>
        <?php endif;?>
	</div>
	<div class="post-info">
		<p>Пришло до Вас...</p>
	</div>
	<div class="clear"></div>
</div>
<div class="post">
	<div class="post-title">
		<div class="post-date">
        <br>
        <p class="post-date-title">От Вас</p>
		</div>			
		<h2>Исходящие сообщения:</h2>
	</div>
	<div class="post-entry">
        <?php if($messagesFrom):?>
        <table border="1" width="98%" bordercolor="black">
            <tr>
                <th>Кому</th>
                <th>Сообщение</th>
                <th>Дата</th>
                <th>Прочитано</th>
                <th>Взаимодействие</th>
            </tr>
            <?php foreach($messagesFrom as $messageFrom):?>
            <tr>
                <td><center><?=$messageFrom['to'];?></center></td>
                <td><center><?=$messageFrom['message'];?></center></td>
                <td><center><?=$messageFrom['date_message'];?></center></td>
                <?php if ($messageFrom['date_read']):?>
                <td><center><?=$messageFrom['date_read'];?></center></td>
                <?php else:?>
                <td><center><b>NEW</b></center></td>
                <?php endif;?>
                <td><center><a href="/messages/?delete=<?=$messageFrom['id'];?>">Удалить</a></center></td>
            </tr>
            <?php endforeach;?>
        </table>
        <?php else:?>
            <p>Сообщений нет</p>
        <?php endif;?>
	</div>
	<div class="post-info">
		<p>Вы отправляли...</p>
	</div>
	<div class="clear"></div>
</div>
<div class="post">
	<div class="post-title">
		<div class="post-date">
        <br>
        <p class="post-date-title">Новое</p>
		</div>			
		<h2>Написать сообщение:</h2>
	</div>
	<div class="post-entry">
        <?php if($userList):?>
        <?php if(($mCount - $mCountBd) != 0):?>
        <form action="#" method="post" enctype="multipart/form-data">
            Выбор пользователя:
            <select class="form_sel_us" name="user_to">
                <?php foreach($userList as $to):?>
                <option value="<?=$to['id'];?>"><?=$to['nickname'];?>(<?=$to['surname'];?> <?=$to['name'];?>)</option>
                <?php endforeach;?>
            </select>
            <br>
            Введите сообщение:
            <textarea class="form_in_mes" name="message"></textarea>
            <button type="submit">Отправить</button>
        </form>
        <?php else:?>
            Вы не можете отправлять сообщения! Сперва удалите старые исходящие сообщения!
        <?php endif;?>
        <?php else:?>
            <p>Вы не можете писать сообщения сами себе</p>
        <?php endif;?>
	</div>
	<div class="post-info">
		<p>Вы можете написать ещё <?=$mCount - $mCountBd;?> сообщений...</p>
	</div>
	<div class="clear"></div>
</div>
<?php else: header("Location: /")?>
<?php endif;?>