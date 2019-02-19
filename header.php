<?php
	session_start();
	header('Content-Type: text/html; charset=utf-8');
	require_once('connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Телефонный справочник</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/skeleton.css">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="jquery-ui.css">
	<link rel="icon" type="image/png" href="images/favicon.png">
	<!--[if IE]>
	<style>
		#mega {
			margin-left: -130px;
		}
		.nav {
			margin-left: -40px;
		}
		.menu > li {
			margin-right: 0px;
		}
		.title {
			font-size: 45px;
		}
		input[type=text] {
			height: 20px;
			font-size: 1.1em;
		}
		.search {
			padding-top: 5px;
		}
		
		#mega {
			padding-left: 150px;
			padding-right: 20px;
		}
	</style>
	<![endif]-->

</head>
<body>
	<?php if (!empty($_SESSION['auth'])): ?>
	<div class="admin"><a href="admin/">Перейти в панель управления</a></div>
	<?php endif; ?>
	<div class="head" id="head">
		<div class="my-column-left">
			<h2 class="title" id="tidle">Телефонный справочник</h2>
		</div>
		<div class="my-column-right">
			<div class="search">
				<form method="GET" action="search.php">
					<input class="my-search" placeholder="Поиск..." type="text" name="search" autocomplete="off" id="be">
				</form>
			</div>
		</div>
	</div>
	<div class="nav">
		<ul class="menu">
			<!-- <li id="struc"><span id="show">></span><span id="hide">v</span>&nbsp;Структура</li> -->
			<li><a href="list.php">Все номера</a></li>
			<li id="print"><a href="print.php" id="pdf" target="_blank">Печать PDF</a></li>
			<!--li><a href="http://web/sv3/upl_prikaz/telefon/13-12-2018.doc">Версия Microsoft Word</a></li-->
			<li><a href="index.php">На главную</a></li>
		</ul>
	</div>