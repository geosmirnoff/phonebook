<?php
	require_once('../connect.php');
	$query = "DELETE FROM tree
				WHERE id = '".$_GET['id']."'";
	mysqli_query($link, $query);
	header('location: workshops.php');