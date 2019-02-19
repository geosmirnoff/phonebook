<?php
	session_start();
	header('Content-Type: text/html; charset=utf-8');
	require_once('../connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $title; ?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<!--[if IE]>
	<style>
		input[type="text"] {
			height: 20px;
			border-radius: 5px;
			font-size: 1.1em;
		}
		select {
			height: 27px;
			border-radius: 5px;
			font-size: 1.1em;
		}
		option {
			margin-top: 100px;
		}
		.six > .u-full-width {
			width: 40%;
		}
		.five > .u-full-width {
			width: 30%;
			min-width: 200px;
		}
		.four > .u-full-width {
			width: 25%;
			min-width: 100px;
			display: inline-block;
			float: left;
		}
		.three > .u-full-width {
			width: 150px;
			min-width: 100px;
		}
		.two > .u-full-width {
			width: 150px;
			min-width: 100px;
		}
		.titles {
			background-color: #fff;
			border-bottom: 2px;
			border-bottom-color: #ccc;
			border-bottom-style: solid;
		}
		.content {
			border-top: 3px;
			border-top-color: #eee;
			border-top-style: solid;
			padding-top: 0px;
		}
		.nav-ul {
			margin-left: -5px;
		}
		p.nav-ul {
			margin-left: 10px;
		}
		.exit {
			margin-top: -33px;
		}
		.btn-exit {
			font-size: 0.8em;
		}
		.filter {
			display: inline-block;
			float: left;
		}
		
	</style>
	<![endif]-->
</head>
<body>