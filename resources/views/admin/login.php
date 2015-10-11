<? 
include($_SERVER['DOCUMENT_ROOT'].'/system/config.php'); 
if($_SESSION['user'])
	header('Location: /admin/');
else 
{
	echo '<!DOCTYPE HTML>
	<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Авторизация</title>
		<link href="/css/reset.css" rel="stylesheet" type="text/css">
		<link href="/css/global.css" rel="stylesheet" type="text/css">
		<link href="/css/grid.css" rel="stylesheet" type="text/css">
		<link href="/admin/css/style.css" rel="stylesheet" type="text/css">
		<link href="/img/favicon/admin.png" rel="shortcut icon">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<script type="text/javascript" src="/admin/func/script.js"></script>
	</head>
	<body class="', $page ,'-page">
		<div class="wrapper">
			<div class="container">
				<div class="row">
					<form action="#" method="post" class="auth col-vs-12 col-xs-8 col-sm-6 col-md-5 col-lg-4 white">
						<div class="title">
							<span>Авторизация</span>
						</div>
						<label>
							<input type="text" name="login" value="', ($_SERVER['SERVER_NAME'] == 'efremovm.ru' ? 'Логин' : 'admin') ,'" maxlength="16">
						</label>
						<label>
							<input type="password" name="password" value="', ($_SERVER['SERVER_NAME'] == 'efremovm.ru' ? '!!!!!!' : '1') ,'" maxlength="32">
						</label>
						<div class="clear"></div>
						<input type="submit" value="Войти" class="button left">
						<div class="left message"></div>
						<div class="clear"></div>
					</form>
				</div>
			</div>
		</div>
	</body>
	</html>';
}
?>