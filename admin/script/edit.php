<?php
	require_once('connect.php');
	if (isset($_POST['chief']))
	{
		$chief = 1;
	} else
	{
		$chief = 0;
	}
	$query = "UPDATE list
				SET workshop_num = '".$_POST['workshop']."', post = '".$_POST['post']."', chief = ".$chief.", fio = '".$_POST['fio']."', phone_num = '".$_POST['phone']."'
				WHERE id = ".$_POST['id'];
	mysqli_query($link, $query);
	header('location: ../list.php?filter-work='.$_POST['work']);