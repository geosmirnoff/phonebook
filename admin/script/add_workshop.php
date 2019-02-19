<?php
	require_once('connect.php');
	$query = "INSERT INTO tree (workshop, parent, name) 
				VALUES ('".$_POST['workshop']."', '".$_POST['parent']."', '".$_POST['name']."')";
	mysqli_query($link, $query);
	header('location: ../add_workshop.php');