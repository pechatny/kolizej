@extends('layouts.admin')
<?
$title = 'Контакты';
include($_SERVER['DOCUMENT_ROOT'] .'/admin/inc/header.php'); 

if(empty($do)) {
	echo '<div class="clear">
		<h1 class="left">', $title ,'</h1>
		<a href="', $page ,'.php?do=add" class="button">Создать новую</a>
	</div>
	<div class="list clear">';
		$res = mysql_query ('
			SELECT 
				* 
			FROM 
				'. $page .'
			ORDER BY
				id
		');
		if(mysql_num_rows($res)) {
			echo '<div class="head row">
				<div class="col col-xs-1">ID</div>
				<div class="col col-xs-1">active?</div>
				<div class="col col-xs-1">Field</div>
				<div class="col col-xs-3">Title</div>
				<div class="col col-xs-2">aTitle</div>
				<div class="col col-xs-4"></div>
				<div class="clear"></div>
			</div>';
			while($data = mysql_fetch_array($res)) {
				echo '<div class="block row">
					<div class="col col-xs-1">
						<b>', $data['id'] ,'</b>
					</div>
					<div class="col col-xs-1">
						<span class="public', $data['active'] ? ' true' : '' ,'" data-bd="', $page ,'" data-id="', $data['id'] ,'"></span>
					</div>
					<div class="col col-xs-1">
						', $data['field'] ,'
					</div>
					<div class="col col-xs-3">
						', $data['title'] ,'
					</div>
					<div class="col col-xs-2">
						', $data['aTitle'] ,'
					</div>
					<div class="col col-xs-4">
						<a href="', $page ,'.php?do=edit&id=', $data['id'] ,'" class="edit">Редактировать</a>
						<a href="', $page ,'.php?do=del&id=', $data['id'] ,'" class="del">Удалить</a>
					</div>
					<div class="clear"></div>
				</div>';
			}
		}
		else {
			echo '<div class="error">
				Найдено <b>0</b> записей
			</div>';	
		}
	echo '</div>';
}
else {
	$type = 'Обработчик';
	if($do == 'add') $type = 'Добавление';
	if($do == 'edit') $type = 'Редактирование';
	if($do == 'del') $type = 'Удаление';
	$type = ' - [ <span>'. $type .'</span> ]';
	echo '<h1>', $title , $type ,'</h1>';
}
if ($do == 'add') {
	echo '<form action="'.$page.'.php?do=new" method="post" name="form1" target="_self" enctype="multipart/form-data">
		<label>
			<div class="signature">Публиковать?</div>
			<div class="field">
				<input type="text" name="active" value="1">
			</div>
		</label>
		<label>
			<div class="signature">Ключ поля:</div>
			<div class="field">
				<input type="text" name="field">
			</div>
		</label>
		<label>
			<div class="signature">Название:</div>
			<div class="field">
				<input type="text" name="title">
			</div>
		</label>
		<label>
			<div class="signature">Заголовок ссылки:</div>
			<div class="field">
				<input type="text" name="aTitle">
			</div>
		</label>
		<label>
			<div class="signature">Адрес ссылки:</div>
			<div class="field">
				<input type="text" name="aHref">
			</div>
		</label>
		<input type="submit" name="submit" value="Добавить" class="button">
	</form>';
}
if ($do == 'new') {
	if(mysql_query ("INSERT INTO ".$page." (active, field, title, aTitle, aHref) VALUES ('".$val['active']."', '".$val['field']."', '".$val['title']."', '".$val['aTitle']."', '".$val['aHref']."')")) 
		echo 'Запись была добавлена';
	else 
		echo '<div class="error">
			<p>Запись <strong>не добавлена</strong>
		</div>'; 
}


if (isset($id) && $do == "edit") {
	$result = mysql_query("SELECT * FROM ".$page." WHERE id='".$id."'",$db);
	$data = mysql_fetch_array($result);
		  
	echo '<form action="',$page,'.php?do=update&id=',$id,'" method="post" target="_self" enctype="multipart/form-data">
		<label>
			<div class="signature">Публиковать?:</div>
			<div class="field">
				<input type="text" name="active" value="',$data['active'],'">
			</div>
		</label>
		<label>
			<div class="signature">Ключ поля:</div>
			<div class="field">
				<input type="text" name="field" value="',$data['field'],'">
			</div>
		</label>
		<label>
			<div class="signature">Название:</div>
			<div class="field">
				<input type="text" name="title" value="',$data['title'],'">
			</div>
		</label>
		<label>
			<div class="signature">Заголовок ссылки:</div>
			<div class="field">
				<input type="text" name="aTitle" value="',$data['aTitle'],'">
			</div>
		</label>
		<label>
			<div class="signature">Адрес ссылки:</div>
			<div class="field">
				<input type="text" name="aHref" value="',$data['aHref'],'">
			</div>
		</label>
		<input type="submit" name="submit" value="Сохранить" class="button">
	</form>';
}

if ($do == 'update') { 	
	if(mysql_query("UPDATE ".$page." SET active='".$val['active']."', field='".$val['field']."', title='".$val['title']."', aTitle='".$val['aTitle']."', aHref='".$val['aHref']."' WHERE id='".$id."'")) 
		echo 'Запись сохранена';
	else 
		echo '<div class="error">
			<p>Запись <strong>не сохранена</strong>
		</div>'; 
	
}

if (isset($id) && $do == 'del') {
	if (mysql_query ("DELETE FROM ".$page." WHERE id=".$id))
		echo 'Запись была удалена'; 
	else 
		echo '<div class="error">
			<p>Запись <strong>не удалена</strong>
		</div>';
}

include($_SERVER['DOCUMENT_ROOT'] .'/admin/inc/footer.php'); 
?>