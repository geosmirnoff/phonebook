<?php
	require_once('header.php');
?>
	<div class="container content" id="content">
		<!-- <form target="_blank" action="print.php" method="POST" id="form-table">
			<input type="hidden"  name="table" value="<?=$_GET['id']; ?>">
		</form> -->
<?php
	$query = "SELECT phone_num, workshop_num, fio, post, chief
				FROM list
					WHERE workshop_num = '".$_GET['id']."' ORDER BY chief DESC";
	$ws = "SELECT name FROM tree WHERE workshop='".$_GET['id']."'";
	$resws = mysqli_query($link, $ws);
	$rowws = mysqli_fetch_assoc($resws);
	$res = mysqli_query($link, $query);
	if (mysqli_num_rows($res) > 0)
	{
		$row = mysqli_fetch_assoc($res);
		echo $query;
		echo "<h4>".$row['workshop_num']." - ".$rowws['name']."</h4>
			<table class='u-full-width'>
				<thead>
					<tr>
					 <th>ФИО</th>
					 <th>Должность</th>
					 <th>Телефон</th>
					</tr>
				</thead>
				<tbody>";
		if (strlen($row['phone_num']) == 9)
		{
			$num = substr($row['phone_num'], 4);
		} else
		{
			$num = $row['phone_num'];
		}
		echo "<tr>
				<td>".$row['fio']."</td>
				<td>".$row['post']."</td>
				<td>";
		$phones = explode(",", $num);
		foreach ($phones as $phone)
		{
			echo $phone."&nbsp;<br>";
		}
		echo "</td></tr>";	
		while ($row = mysqli_fetch_assoc($res))
		{
			if (strlen($row['phone_num']) == 9)
			{
				$num = substr($row['phone_num'], 4);
			} else
			{
				$num = $row['phone_num'];
			}
				echo "<tr>
						<td>".$row['fio']."</td>
						<td>".$row['post']."</td>
						<td>";
				$phones = explode(",", $num);
				foreach ($phones as $phone)
				{
					echo $phone."&nbsp;<br>";
				}
				echo "</td></tr>";	
		}
		echo "</tbody></table>";
	} else
	{
		switch ($_GET['id']{0})
		{
			case 0: 
				$podr = "цеху ";
				break;
			case 4: 
				$podr = "отделу ";
				break;
			case 5: 
				$podr = "управлению ";
				break;
		}
		echo "<h4>Нет данных по ".$podr.$_GET['id']." :(</h4>";
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