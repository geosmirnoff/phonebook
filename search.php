<?php
	require_once('header.php');
?>
<div class="container content" id="content">
<?php
	require_once('connect.php');
	$search = $_GET['search'];
	$query = "SELECT phone_num, workshop_num, fio, post
				FROM list
					WHERE phone_num LIKE '%$search%'
					OR workshop_num LIKE '%$search%'
					OR fio LIKE '%$search%'
					OR post LIKE '%$search%'";
	$res = mysqli_query($link, $query);
	echo "<h4>Резульаты поиска по запросу \"".$_GET['search']."\"</h4>";
	if (mysqli_num_rows($res) > 0)
	{
		echo "<table class='u-full-width'>
				<thead>
					<tr>
					 <th>ФИО</th>
					 <th>Подразделение</th>
					 <th>Должность</th>
					 <th>Телефон</th>
					</tr>
				</thead>
				<tbody>";	
		while ($row = mysqli_fetch_assoc($res))
		{
			switch ($row['workshop_num']{0})
			{
				case 0: 
					$podr = "Цех ";
					break;
				case 4: 
					$podr = "Отдел ";
					break;
				case 5: 
					$podr = "Управление ";
					break;
				default:
					$podr = "";
			}
			if (strlen($row['phone_num']) == 9)
			{
				$num = substr($row['phone_num'], 4);
			} else
			{
				$num = $row['phone_num'];
			}
			$phones = explode(",", $num);
			echo "<tr>
					<td>".$row['fio']."</td>
					<td>".$podr.$row['workshop_num']."</td>
					<td>".$row['post']."</td><td>";
			foreach ($phones as $phone)
			{
				echo $phone."&nbsp;<br>";
			}
			echo "</td></tr>";

		}
		echo "</tbody></table>";
	} else
	{
		echo "<p>Ничего не найдено :(</p>";
	}
?>
</div>
<div class="megamenu" id="mega">
	<ul id="menu"></ul>
</div>
<script src="script.js"></script>
<script type="text/javascript">
stroka();
</script>
</body>
</html>