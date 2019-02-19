<?php
	require_once('connect.php');
	$query = "UPDATE tree
				SET workshop = '".$_POST['workshop']."', name = '".$_POST['name']."'
					WHERE id = '".$_POST['id']."'";
	mysqli_query($link, $query);
	$search = "";
	if (isset($_POST['search']))
	{
		$search = "?search=".$_POST['search'];
	}
	header('location: ../workshops.php'.$search);