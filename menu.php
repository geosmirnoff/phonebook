<?php

//Устанавливаем кодировку и вывод всех ошибок
header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ALL);

//Объектно-ориентированный стиль
$mysqli = new mysqli('172.16.88.3', 'root', 'web', 'phone');

//Устанавливаем кодировку utf8
$mysqli->query("SET NAMES 'utf8'");

if (mysqli_connect_error()) {
    die('Ошибка подключения (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}

//Получаем массив нашего меню из БД в виде массива
function getCat($mysqli) {
	$sql = 'SELECT * FROM `tree`';
	$res = $mysqli->query($sql);

	//Создаем масив где ключ массива является ID меню
	$cat = array();
	while($row = $res->fetch_assoc()){
		$cat[$row['id']] = $row;
	}
	return $cat;
}

//Функция построения дерева из массива от Tommy Lacroix
function getTree($dataset) {
	$tree = array();

	foreach ($dataset as $id => &$node) {    
		//Если нет вложений
		if (!$node['parent']){
			$tree[$id] = &$node;
		} else
		{ 
			//Если есть потомки то перебираем массив
            $dataset[$node['parent']]['childs'][$id] = &$node;
		}
	}
	return $tree;
}

//Получаем подготовленный массив с данными
$cat  = getCat($mysqli); 

//Создаем древовидное меню
$tree = getTree($cat);

//Шаблон для вывода меню в виде дерева
function tplMenu($category) {
	$menu = '<li><a href="table.php?id='.$category['workshop'].'">'. 
		$category['workshop'].' '.$category['name'].'</a>';
		
	if (isset($category['childs']))
	{
		$menu .= '<ul class="'.$category['workshop'].'">'. showCat($category['childs']) .'</ul>';
	}
	$menu .= '</li>';
	
	return $menu;
}

/**
* Рекурсивно считываем наш шаблон
**/
function showCat($data) {
	$string = '';
	foreach($data as $item)
	{
		$string .= tplMenu($item);
	}
	return $string;
}

//Получаем HTML разметку
$cat_menu = showCat($tree);

//Выводим на экран
echo $cat_menu;