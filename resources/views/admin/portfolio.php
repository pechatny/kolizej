<? 
include($_SERVER['DOCUMENT_ROOT'] .'/admin/inc/lock.php');

if (isset($_GET['id']))           { $id = inj($_GET['id'],1); }
if (isset($_GET['do']))           { $do = inj($_GET['do'],0); }

foreach($_POST as $key => $value) { 
	if($key != 'submit') {
		$val[$key] = $_POST[$key]; 
	}
}

$title = 'Портфолио';
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
				dateCreate DESC
		');
		if(mysql_num_rows($res)) {
			echo '<div class="head row">
				<div class="col col-xs-1">ID</div>
				<div class="col col-xs-1">active?</div>
				<div class="col col-xs-4">Название</div>
				<div class="col col-xs-2">Дата создания</div>
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
					<div class="col col-xs-4">
						', $data['title'] ,'
					</div>
					<div class="col col-xs-2">
						', $data['dateCreate'] ,'
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
	$data = mysql_fetch_array(mysql_query('SHOW TABLE STATUS FROM '. $bd_S .' WHERE Name = "'. $page .'"'));
	echo '<form action="'.$page.'.php?do=new" method="post" name="form1" target="_self" enctype="multipart/form-data">
		<label>
			<div class="signature">ID:</div>
			<div class="field">
				<input type="text" name="id" value="', $data['Auto_increment'] ,'" disabled>
			</div>
		</label>
		<label>
			<div class="signature">Публиковать:</div>
			<div class="field">
				<input type="text" name="active" value="1">
			</div>
		</label>
		<label>
			<div class="signature">Категория:</div>
			<div class="field">
				<select name="category">';
					foreach($category as $name => $value)
						echo '<option value="', $name ,'">', $value ,'</option>';
				echo '</select>
			</div>
		</label>
		<label>
			<div class="signature">Ссылка <b>en</b>:</div>
			<div class="field">
				<input type="text" name="en">
			</div>
		</label>
		<label>
			<div class="signature">Дата создания:</div>
			<div class="field">
				<input type="text" name="dateCreate" value="', date('Y-m-d') ,'">
			</div>
		</label>
		<label>
			<div class="signature">Название:</div>
			<div class="field">
				<input type="text" name="title">
			</div>
		</label>
		<label>
			<div class="signature">Ссылка:</div>
			<div class="field">
				<input type="text" name="link" value="http://">
			</div>
		</label>
		<div class="adaptive">
			<div class="signature">Адаптивность:</div>
			<div class="field row">
				<div class="col-xs-6">
					<input type="text" name="adaptive">
				</div>
				<div class="add col-xs-6">
					<input type="text" class="left">
					<span class="button" class="left">Добавить</span>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="h15"></div>';
		
		$resTechno = mysql_query ('
			SELECT 
				id,
				title 
			FROM 
				techno
			ORDER BY
				id
		');
		if(mysql_num_rows($resTechno)) {
			echo '<div class="technos">
				<div class="signature">Технологии:</div>
				<div class="field row">
					<div class="col-xs-3">
						<input type="text" name="techno">
					</div>
					<div class="list col-xs-9">';
						while($dataTechno = mysql_fetch_array($resTechno)) {
							echo '<span data-id="', $dataTechno['id'] ,'">
								<img src="/img/button/techno/', strtolower($dataTechno['title']) ,'.png" alt="">
							</span>';
						}	
					echo '</select>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="h15"></div>';
		}
		$folder = $_SERVER['DOCUMENT_ROOT'] .'/img/portfolio/'. $data['Auto_increment'] .'/';
		$images = glob($folder .'*');
		for($i = 0, $to = count($images), $logo = -1; $i < $to; $i++) {
			$images[$i] = strtr($images[$i], array($folder => ''));
			if($images[$i] == 'logo.png')
				$logo = $i;
		}
		if($logo > 0)
			array_splice($images, $logo, 1);
		echo '<label>
			<div class="signature">Текст:</div>
			<div class="field">
				<textarea name="text"></textarea>
			</div>
		</label>
		<label>
			<div class="signature">Изображения:</div>
			<div class="field">
				<input type="text" name="images" value="', implode(';', $images) ,'">
			</div>
		</label>
		<input type="submit" name="submit" value="Добавить" class="button">
	</form>';
}
if ($do == 'new') {
	if(mysql_query ("INSERT INTO ".$page." (dateAdd, timeAdd, active, category, en, title, dateCreate, link, adaptive, techno, text, images) VALUES ('".date('Y-m-d')."', '".date('H:i:s')."', '".$val['active']."', '".$val['category']."', '".$val['en']."', '".$val['title']."', '".$val['dateCreate']."', '".$val['link']."', '".$val['adaptive']."', '".$val['techno']."', '".$val['text']."', '".$val['images']."')")) {
		echo '<p>Запись была добавлена';
	}
	else 
		echo '<div class="error">
			<p>Запись <strong>не добавлена</strong>
		</div>';
	$data = mysql_fetch_array(mysql_query("SELECT id FROM ".$page." ORDER BY id DESC LIMIT 1",$db)); 
	$dir = $_SERVER['DOCUMENT_ROOT'].'/img/portfolio/'.$data['id'];
	if(!file_exists($dir)) 
		mkdir($dir);
}


if (isset($id) && $do == "edit") {
	$result = mysql_query("SELECT * FROM ".$page." WHERE id='".$id."'",$db);
	$data = mysql_fetch_array($result);
		  
	echo '<form action="',$page,'.php?do=update&id=',$id,'" method="post" target="_self" enctype="multipart/form-data">
		<label>
			<div class="signature">Публиковать:</div>
			<div class="field">
				<input type="text" name="active" value="', $data['active'] ,'">
			</div>
		</label>
		<label>
			<div class="signature">Категория:</div>
			<div class="field">
				<select name="category">';
					foreach($category as $name => $value)
						echo '<option value="', $name ,'"',$name == $data['category'] ? ' selected="selected"' : '','>', $value ,'</option>';
				echo '</select>
			</div>
		</label>
		<label>
			<div class="signature">Ссылка <b>en</b>:</div>
			<div class="field">
				<input type="text" name="en" value="', $data['en'] ,'">
			</div>
		</label>
		<label>
			<div class="signature">Дата создания:</div>
			<div class="field">
				<input type="text" name="dateCreate" value="', $data['dateCreate'] ,'">
			</div>
		</label>
		<label>
			<div class="signature">Название:</div>
			<div class="field">
				<input type="text" name="title" value="', $data['title'] ,'">
			</div>
		</label>
		<label>
			<div class="signature">Ссылка:</div>
			<div class="field">
				<input type="text" name="link" value="', $data['link'] ,'">
			</div>
		</label>
		<div class="adaptive">
			<div class="signature">Адаптивность:</div>
			<div class="field row">
				<div class="col-xs-6">
					<input type="text" name="adaptive" value="', $data['adaptive'] ,'">
				</div>
				<div class="add col-xs-6">
					<input type="text" class="left">
					<span class="button" class="left">Добавить</span>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="h15"></div>';
		
		$resTechno = mysql_query ('
			SELECT 
				id,
				title 
			FROM 
				techno
			ORDER BY
				id
		');
		if(mysql_num_rows($resTechno)) {
			echo '<div class="technos">
				<div class="signature">Технологии:</div>
				<div class="field row">
					<div class="col-xs-3">
						<input type="text" name="techno" value="', $data['techno'] ,'">
					</div>
					<div class="list col-xs-9">';
						$selectTechno = explode(';', $data['techno']);
						while($dataTechno = mysql_fetch_array($resTechno)) {
							echo '<span data-id="', $dataTechno['id'] ,'"', in_array($dataTechno['id'], $selectTechno) ? ' class="active"' : '' ,'>
								<img src="/img/button/techno/', strtolower($dataTechno['title']) ,'.png" alt="">
							</span>';
						}	
					echo '</select>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="h15"></div>';
		}
		echo '<label>
			<div class="signature">Текст:</div>
			<div class="field">
				<textarea name="text">', $data['text'] ,'</textarea>
			</div>
		</label>
		<div class="images">
			<div class="signature">Изображения:</div>
			<div class="field row">
				<div class="col-xs-3">
					<input type="text" name="images" value="', $data['images'] ,'">
				</div>
				<div class="list col-xs-9">';
					$data['images'] = explode(';', $data['images']);
					for($i = 0, $to = count($data['images']), $list = array(); $i < $to; $i++) {
						$data['images'][$i] = explode('~', $data['images'][$i]);
						$list[] = $data['images'][$i][0];
					}
					$folder = $_SERVER['DOCUMENT_ROOT'] .'/img/portfolio/'. $data['id'] .'/';
					$images = glob($folder .'*');
					foreach($images as $value) {
						$value = strtr($value, array($folder => ''));
						if($value != 'logo.png') {
							echo '<span', in_array($value, $list) ? ' class="active"' : '' ,'>', $value ,'</span>';
						}
					}
				echo '</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="h15"></div>
		
		<input type="submit" name="submit" value="Сохранить" class="button">
		<div class="h15"></div>
		
		<div class="imagesCut">';
			if(!empty($data['images'][0][0])) {
				for($i = 0, $to = count($data['images']); $i < $to; $i++) {
					$src = '/img/portfolio/'. $data['id'] .'/'. $data['images'][$i][0];
					list($width, $height) = getimagesize($_SERVER['DOCUMENT_ROOT'] . $src);
					echo '<div class="block" data-src="', strtr($data['images'][$i][0], array('.' => '-tchk-')) ,'">
						<div class="image">
							<img src="', $src ,'" alt="" style="max-width:', $width ,'px;max-height:', $height ,'px;">
							<div class="area"></div>
						</div>
						<input type="text" value="', $data['images'][$i][1] ,'">
						<div class="close"></div>
					</div>';
				}
			}
		echo '</div>
	</form>';
}

if ($do == 'update') {	
	if(mysql_query("UPDATE ".$page." SET active='".$val['active']."', category='".$val['category']."', en='".$val['en']."', title='".$val['title']."', dateCreate='".$val['dateCreate']."', link='".$val['link']."', adaptive='".$val['adaptive']."', techno='".$val['techno']."', text='".$val['text']."', images='".$val['images']."' WHERE id='".$id."'")) 
		echo '<p>Запись сохранена
		<p><a href="/admin/', $page ,'.php?do=edit&id=', $id ,'" class="button">Вернуться</a>';
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