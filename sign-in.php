<?php
	session_start();
	require_once('connect.php');
	$title = "Вход";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="text/html" />
	<link rel="stylesheet" href="css/style-sign-in.css" type="text/css" />
	<link rel="stylesheet" href="css/skeleton.css" type="text/css" />
	<link rel="stylesheet" href="css/normalize.css" type="text/css" />
	<title><?php echo $title; ?></title>
	<!--[if IE]>
	<style>
		input[type=text], input[type=password] {
			height: 20px;
			font-size: 1.1em;
		}
		.eight > .u-full-width {
			width: 180px;
		}

	</style>
	<![endif]-->
</head>
<body>
<?php
	if (isset($_SESSION['auth']) && ($_SESSION['rights'] == 10))
	{
		header('location: admin/index.php');
	}
	$msg = '';
	if (!empty($_POST['login']) && !empty($_POST['password']))
	{
		$login = $_POST['login'];
		$password = $_POST['password'];
		$query = "SELECT * FROM users WHERE login='".$login."'";
		$result = mysqli_query($link, $query);
		$user = mysqli_fetch_assoc($result);
		if (!empty($user))
		{
			$hashedPass = md5($password);
			if($user['password'] == $hashedPass)
			{
				$_SESSION['auth'] = true;
				$_SESSION['uid'] = $user['id'];
				$_SESSION['login'] = $user['login'];
				$_SESSION['uname'] = $user['name'];
				/*$_SESSION['workshop'] = $user['workshop'];*/
				$_SESSION['rights'] = $user['rights'];
				if ($_SESSION['rights'] == 10)
				{
					header('location: admin/index.php');
				} else
				{
					$msg = '<span class="error">У Вас нет прав админитратора!</span>';
				}
				
			} else
			{
				$msg =  '<span class="error">Неверный пароль!</span>';
			}
		} else
		{
			$msg = '<span class="error">Нет такого логина!</span>';
		}			
	}
?>
<div class="container">
	<div class="wrap-login">
		<div class="login-form">
			<form method="POST">
				<div class="row">
					<div class="eight columns">
						<label for="inputLogin">Пользователь</label>
						<input name="login" class="u-full-width" id="inputLogin" type="text" autocomplete="off">
					</div>
				</div>
				<div class="row">
					<div class="eight columns">
						<label for="inputPass">Пароль</label>
						<input name="password" class="u-full-width" id="inputPass" type="password"autocomplete="off"><br>
						<?php echo $msg; ?>
					</div>
				</div>
				<div class="row">
					<button type="submit" class="my-btn">Войти</button>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>