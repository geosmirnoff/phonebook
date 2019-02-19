<?php
	$file_list = scandir('http://web/sv3/upl_prikaz/telefon',1); 
	header("Content-Description: File Transfer");
	header('Content-Transfer-Encoding: binary');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header("Content-type: application/ms-word");
	header("Content-type: application/force-download");
	header("Content-length:".filesize("http://web/sv3/upl_prikaz/telefon/".$file_list[0]));
	header("Content-Disposition: attachment; filename=".$file_list[0]); 
	$x = fread(fopen("http://web/sv3/upl_prikaz/telefon/".$file_list[0], "rb"), filesize("http://web/sv3/upl_prikaz/telefon/".$file_list[0]));  
	echo $x;