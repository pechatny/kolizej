<? 
include($_SERVER['DOCUMENT_ROOT'] .'/admin/inc/lock.php');

if (isset($_GET['id']))           { $id = inj($_GET['id'],1); }
if (isset($_GET['do']))           { $do = inj($_GET['do'],0); }

foreach($_POST as $key => $value) { 
	if($key != 'submit') {
		$val[$key] = $_POST[$key]; 
	}
}

$title = 'Страницы';
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
				<div class="col col-xs-2">Page</div>
				<div class="col col-xs-7">Title</div>
				<div class="col col-xs-2"></div>
				<div class="clear"></div>
			</div>';
			while($data = mysql_fetch_array($res)) {
				echo '<div class="block row">
					<div class="col col-xs-1">
						<b>', $data['id'] ,'</b>
					</div>
					<div class="col col-xs-2">
						', $data['page'] ,'
					</div>
					<div class="col col-xs-5">
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
	echo '<form action="'.$page.'.php?do=new" method="post" name="form1" target="_self" enctype="multipart/form-data">
		<label>
			<div class="signature">Страница:</div>
			<div class="field">
				<select name="page">';
					for($i = 0, $to = count($pages = glob('../*.php')); $i < $to; $i++) {
						$name = str_replace('../', '', $pages[$i]);
						echo '<option value="',str_replace('.php', '', $name),'">',$name,'</option>';
					}
				echo '</select>
			</div>
		</label>
		<label>
			<div class="signature">Описание:</div>
			<div class="field">
				<input type="text" name="metaD">
			</div>
		</label>
		<label>
			<div class="signature">Ключевые слова:</div>
			<div class="field">
				<input type="text" name="metaK">
			</div>
		</label>
		<label>
			<div class="signature">Заголовок <b>TITLE</b>:</div>
			<div class="field">
				<input type="text" name="title">
			</div>
		</label>
		<label>
			<div class="signature">Заголовок <b>H1</b>:</div>
			<div class="field">
				<input type="text" name="head">
			</div>
		</label>
		<label>
			<div class="signature">Текст:</div>
			<div class="field">
				<textarea name="text"></textarea>
			</div>
		</label>
		<label>
			<div class="signature">Элементы:</div>
			<div class="field">
				<input type="text" name="el" value="0">
			</div>
		</label>
		<input type="submit" name="submit" value="Добавить" class="button">
	</form>';
}
if ($do == 'new') {
	if(mysql_query ("INSERT INTO ".$page." (page, metaD, metaK, title, head, text, el) VALUES ('".$val['page']."', '".$val['metaD']."', '".$val['metaK']."', '".$val['title']."', '".$val['head']."', '".$val['text']."', '".$val['el']."')")) 
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
			<div class="signature">Страница:</div>
			<div class="field">
				<select name="page">';
					for($i = 0, $to = count($pages = glob('../*.php')); $i < $to; $i++) {
						$name = str_replace('../', '', $pages[$i]);
						echo '<option value="',str_replace('.php', '', $name),'"',$name == $data['page'].'.php' ? ' selected="selected"' : '','>',$name,'</option>';
					}
				echo '</select>
			</div>
		</label>
		<label>
			<div class="signature">Описание:</div>
			<div class="field">
				<input type="text" name="metaD" value="',$data['metaD'],'">
			</div>
		</label>
		<label>
			<div class="signature">Ключевые слова:</div>
			<div class="field">
				<input type="text" name="metaK" value="',$data['metaK'],'">
			</div>
		</label>
		<label>
			<div class="signature">Заголовок <b>TITLE</b>:</div>
			<div class="field">
				<input type="text" name="title" value="',$data['title'],'">
			</div>
		</label>
		<label>
			<div class="signature">Заголовок <b>H1</b>:</div>
			<div class="field">
				<input type="text" name="head" value="',$data['head'],'">
			</div>
		</label>
		<label>
			<div class="signature">Текст:</div>
			<div class="field">
				<textarea name="text">',$data['text'],'</textarea>
			</div>
		</label>
		<label>
			<div class="signature">Элементы:</div>
			<div class="field">
				<input type="text" name="el" value="',$data['el'],'">
			</div>
		</label>
		<input type="submit" name="submit" value="Сохранить" class="button">
	</form>';
}

if ($do == 'update') { 		
	if(mysql_query("UPDATE ".$page." SET page='".$val['page']."', metaD='".$val['metaD']."', metaK='".$val['metaK']."', title='".$val['title']."', head='".$val['head']."', text='".$val['text']."', el='".$val['el']."' WHERE id='".$id."'")) 
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