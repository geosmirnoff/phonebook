<?php
	header( 'Content-Type: text/html; charset=utf-8' );
	$host = '172.16.88.3'; 
	$root = 'root'; 
	$password = 'web'; 
	$db_name = 'phone'; 
	$link = mysqli_connect($host, $root, $password, $db_name) or die (mysqli_error($link));
	mysqli_set_charset($link, 'utf8');