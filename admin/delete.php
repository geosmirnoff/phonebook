<?php
	require_once('../connect.php');
	$query = "DELETE FROM list
				WHERE id = '".$_GET['id']."'";
	mysqli_query($link, $query);
	header('location: list.php?filter-work='.$_GET['workshop']);