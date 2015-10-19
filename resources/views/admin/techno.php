<? 
include($_SERVER['DOCUMENT_ROOT'] .'/admin/inc/lock.php');

if (isset($_GET['id']))           { $id = inj($_GET['id'],1); }
if (isset($_GET['do']))           { $do = inj($_GET['do'],0); }

foreach($_POST as $key => $value) { 
	if($key != 'submit') {
		$val[$key] = $_POST[$key]; 
	}
}

$title = 'Технологии';
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
				id DESC
		');
		if(mysql_num_rows($res)) {
			echo '<div class="head row">
				<div class="col col-xs-1">ID</div>
				<div class="col col-xs-1">Img</div>
				<div class="col col-xs-6">Title</div>
				<div class="col col-xs-4"></div>
				<div class="clear"></div>
			</div>';
			while($data = mysql_fetch_array($res)) {
				echo '<div class="block row">
					<div class="col col-xs-1">
						<b>', $data['id'] ,'</b>
					</div>
					<div class="col col-xs-1">
						<img src="/img/button/techno/', strtolower($data['title']) ,'.png" alt="">
					</div>
					<div class="col col-xs-6">
						', $data['title'] ,'
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
	if(file_exists($_SERVER['DOCUMENT_ROOT'].'/admin/func/upload/temp.png'))
		unlink($_SERVER['DOCUMENT_ROOT'].'/admin/func/upload/temp.png');
	echo '<form action="/admin/func/upload/uploader.php?do=', $page ,'" name="upload_form" id="upload_form" method="post" target="upload_file" enctype="multipart/form-data" onsubmit="return true;">
		<label class="uploadImg">
			<div class="signature">Изображение:</div>
			<div class="field row">
				<div class="col-xs-4">
					<input name="file" id="file" type="file" size="20" class="file">
				</div>
				<div class="preview col-xs-8" id="file_status"></div>
				<div class="clear"></div>
			</div>
		</label>
	</form>
	<iframe src="" id="upload_file" name="upload_file"></iframe>
	<form action="'.$page.'.php?do=new" method="post" name="form1" target="_self" enctype="multipart/form-data">
		<label>
			<div class="signature">Название:</div>
			<div class="field">
				<input type="text" name="title">
			</div>
		</label>
		<input type="submit" name="submit" value="Добавить" class="button">
	</form>';
}
if ($do == 'new') {
	if(mysql_query ("INSERT INTO ".$page." (title) VALUES ('".$val['title']."')")) 
		echo '<p>Запись была добавлена';
	else {
		echo $error = '<p>Запись <strong>не добавлена</strong>';
	}
	
	if(file_exists($_SERVER['DOCUMENT_ROOT'].'/admin/func/upload/temp.png')) {
		if(copy($_SERVER['DOCUMENT_ROOT'].'/admin/func/upload/temp.png', $_SERVER['DOCUMENT_ROOT'].'/img/button/techno/'. strtolower($val['title']) .'.png')) {
			echo '<p>Изображение успешно загружено';
			unlink($_SERVER['DOCUMENT_ROOT'].'/admin/func/upload/temp.png');
		}
		else 
			$error .= '<p>Ошибка копирования файла';
	}
	else 
		$error .= '<p>Файл не найден';
	if($error) 
		echo '<div class="error">', $error ,'</div>';
}


if (isset($id) && $do == "edit") {
	$result = mysql_query("SELECT * FROM ".$page." WHERE id='".$id."'",$db);
	$data = mysql_fetch_array($result);
	if(file_exists($_SERVER['DOCUMENT_ROOT'].'/admin/func/upload/temp.png'))
		unlink($_SERVER['DOCUMENT_ROOT'].'/admin/func/upload/temp.png');
	echo '<form action="/admin/func/upload/uploader.php?do=', $page ,'" name="upload_form" id="upload_form" method="post" target="upload_file" enctype="multipart/form-data" onsubmit="return true;">
		<label class="uploadImg">
			<div class="signature">Изображение:</div>
			<div class="field row">
				<div class="col-xs-4">
					<input name="file" id="file" type="file" size="20" class="file">
				</div>
				<div class="preview col-xs-8" id="file_status">
					<a href="/img/button/techno/', strtolower($data['title']) ,'.png" target="_blank">
						<img src="/img/button/techno/', strtolower($data['title']) ,'.png?',mt_rand(0, 10000),'">
					</a>
				</div>
				<div class="clear"></div>
			</div>
		</label>
	</form>
	<iframe src="" id="upload_file" name="upload_file"></iframe>
	<form action="',$page,'.php?do=update&id=',$id,'" method="post" target="_self" enctype="multipart/form-data">
		<label>
			<div class="signature">Название:</div>
			<div class="field">
				<input type="text" name="title" value="',$data['title'],'">
			</div>
		</label>
		<input type="submit" name="submit" value="Сохранить" class="button">
	</form>';
}

if ($do == 'update') { 	
	$data = mysql_fetch_array(mysql_query("SELECT title FROM ".$page." WHERE id='".$id."'",$db));
	if(mysql_query("UPDATE ".$page." SET title='".$val['title']."' WHERE id='".$id."'"))
		echo '<p>Запись сохранена';
	else 
		echo $error = '<p>Запись <strong>не сохранена</strong>'; 
	
			   	
	if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/admin/func/upload/temp.png')) {
		if(strtolower($data['title']) != strtolower($val['title'])) {
			rename($_SERVER['DOCUMENT_ROOT'].'/img/button/techno/'. strtolower($data['title']) .'.png', 
				   $_SERVER['DOCUMENT_ROOT'].'/img/button/techno/'. strtolower($val['title']) .'.png');
		}
	}
	else {
		if(copy($_SERVER['DOCUMENT_ROOT'].'/admin/func/upload/temp.png', $_SERVER['DOCUMENT_ROOT'].'/img/button/techno/'. strtolower($val['title']) .'.png')) {
			echo '<p>Изображение успешно загружено';
			unlink($_SERVER['DOCUMENT_ROOT'].'/admin/func/upload/temp.png');
		}
		else 
			$error .= '<p>Ошибка копирования файла';
	}
	if($error) 
		echo '<div class="error">', $error ,'</div>';
	
}

if (isset($id) && $do == 'del') {
	$data = mysql_fetch_array(mysql_query("SELECT title FROM ".$page." WHERE id='".$id."'",$db));
	if (mysql_query ("DELETE FROM ".$page." WHERE id=".$id) && unlink($_SERVER['DOCUMENT_ROOT'].'/img/button/techno/'. strtolower($data['title']) .'.png'))
		echo 'Запись была удалена'; 
	else 
		echo '<div class="error">
			<p>Запись <strong>не удалена</strong>
		</div>';
}

include($_SERVER['DOCUMENT_ROOT'] .'/admin/inc/footer.php'); 
?>