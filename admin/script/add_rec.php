<?php
	require_once('connect.php');
	if (isset($_POST['chief']))
	{
		$chief = 1;
	} else
	{
		$chief = 0;
	}
	$query = "INSERT INTO list (phone_num, workshop_num, fio, chief, post) 
				VALUES ('".$_POST['phone']."', '".$_POST['workshop']."', '".$_POST['fio']."', ".$chief.", '".$_POST['post']."')";
	mysqli_query($link, $query);
	header('location: ../add_rec.php');