<?php
	require_once('header.php');
?>
<div class="container content">
	<form method="GET">
		<!-- <label>Цех: </label> -->
		<?php
			$query = "SELECT * FROM tree ORDER BY workshop ASC";
			$res = mysqli_query($link, $query);
			$res2 = mysqli_query($link, $query);
			$res3 = mysqli_query($link, $query);
			$res4 = mysqli_query($link, $query);
		?>
		<!-- <label>Управление: </label> -->
		<select name="upr">
			<option disabled selected>Выберите управление</option>
			<?php while ($row = mysqli_fetch_assoc($res)): ?>
				<?php if ($row['workshop']{0} == 5): ?>
					<option value="<?=$row['workshop'];?>"
					<?php
						if (isset($_GET['upr']) && $_GET['upr'] == $row['workshop'])
						{
							echo "selected";
						}
					?>
						>
						Управление <?php echo $row['workshop'];?>
					</option>
				<?php endif; ?>
			<?php endwhile; ?>
		</select>
		<!-- <label>Отдел: </label> -->
		<select name="otd">
			<option disabled selected>Выберите отдел</option>
			<?php while ($row = mysqli_fetch_assoc($res2)): ?>
				<?php if ($row['workshop']{0} == 4): ?>
					<option value="<?=$row['workshop'];?>"
					<?php
						if (isset($_GET['otd']) && $_GET['otd'] == $row['workshop'])
						{
							echo "selected";
						}
					?>
						>Отдел <?php echo $row['workshop'];?>
					</option>
				<?php endif; ?>
			<?php endwhile; ?>
		</select>
		<select name="cex">
			<option disabled selected>Выберите цех</option>
			<?php while ($row = mysqli_fetch_assoc($res3)): ?>
				<?php if ($row['workshop']{0} == 0): ?>
					<option value="<?=$row['workshop'];?>"
					<?php
						if (isset($_GET['cex']) && $_GET['cex'] == $row['workshop'])
						{
							echo "selected";
						}
					?>
						>Цех <?php echo $row['workshop'];?>
					</option>
				<?php endif; ?>
			<?php endwhile; ?>
		</select>
		<!-- <label>Контрагент: </label> -->
		<select name="kontr">
			<option disabled selected>Выберите контрагента</option>
			<?php while ($row = mysqli_fetch_assoc($res4)): ?>
				<?php if ($row['workshop']{0} == 8): ?>
					<option value="<?=$row['workshop'];?>"
					<?php
						if (isset($_GET['contr']) && $_GET['contr'] == $row['workshop'])
						{
							echo "selected";
						}
					?>
						><?php echo $row['workshop'];?>
					</option>
				<?php endif; ?>
			<?php endwhile; ?>
		</select>
		<input type="submit" name="" value="Фильтр">
		<button type="submit" name="reset">Сброс</button>
	</form>
	<?php
		if (isset($_GET['reset']))
		{
			header('location: list.php');
		}
		/*if (isset($_GET['upr']))
		{
			$work = $_GET['upr'];
		} elseif (isset($_GET['otd']))
		{
			$work = $_GET['otd'];
		} elseif (isset($_GET['cex']))
		{
			$work = $_GET['cex'];
		} elseif (isset($_GET['contr']))
		{
			$work = $_GET['contr'];
		}*/
	?>
	<?php if (isset($_GET['upr'])): ?>
		<?php
			$query_upr = "SELECT * FROM list
							WHERE workshop_num = '".$_GET['upr']."' ORDER BY chief DESC";
			$res_upr = mysqli_query($link, $query_upr);
			$query_upr_name = "SELECT name FROM tree
								WHERE workshop = ".$_GET['upr'];
			$res_upr_name = mysqli_query($link, $query_upr_name);
			$row_upr_name = mysqli_fetch_assoc($res_upr_name);
		?>
		<?php if (mysqli_num_rows($res_upr) > 0): ?>
			<h2><?php echo $_GET['upr']." - ".$row_upr_name['name']; ?></h2>
			<table>
				<thead>
					<tr>
						<th>ФИО</th>
						<th>Должность</th>
						<th>Телефон</th>
					</tr>
				</thead>
				<tbody>
				<?php while ($row_upr = mysqli_fetch_assoc($res_upr)): ?>
					<?php
						if (strlen($row_upr['phone_num']) == 9)
						{
							$num = substr($row_upr['phone_num'], 4);
						} else
						{
							$num = $row_upr['phone_num'];
						}
					?>
					<tr>
						<td><?php echo $row_upr['fio']; ?></td>
						<td><?php echo $row_upr['post']; ?></td>
						<td>
						<?php 
							$phones = explode(",", $num);
							foreach ($phones as $phone)
							{
								echo $phone."&nbsp;<br>";
							}
						?>	
						</td>
					</tr>
				<?php endwhile;?>
				</tbody>
			</table>
		<?php endif; ?>
	<?php endif;?>

	<?php if (isset($_GET['otd'])): ?>
		<?php
			$query_otd = "SELECT * FROM list
							WHERE workshop_num = '".$_GET['otd']."' ORDER BY chief DESC";
			$res_otd = mysqli_query($link, $query_otd);
			$query_otd_name = "SELECT name FROM tree
								WHERE workshop = ".$_GET['otd'];
			$res_otd_name = mysqli_query($link, $query_otd_name);
			$row_otd_name = mysqli_fetch_assoc($res_otd_name);
		?>
		<?php if (mysqli_num_rows($res_otd) > 0): ?>
			<h2><?php echo $_GET['otd']." - ".$row_otd_name['name']; ?></h2>
			<table>
				<thead>
					<tr>
						<th>ФИО</th>
						<th>Должность</th>
						<th>Телефон</th>
					</tr>
				</thead>
				<tbody>
				<?php while ($row_otd = mysqli_fetch_assoc($res_otd)): ?>
					<?php
						if (strlen($row_otd['phone_num']) == 9)
						{
							$num = substr($row_otd['phone_num'], 4);
						} else
						{
							$num = $row_otd['phone_num'];
						}
					?>
					<tr>
						<td><?php echo $row_otd['fio']; ?></td>
						<td><?php echo $row_otd['post']; ?></td>
						<td>
						<?php 
							$phones = explode(",", $num);
							foreach ($phones as $phone)
							{
								echo $phone."&nbsp;<br>";
							}
						?>	
						</td>
					</tr>
				<?php endwhile;?>
				</tbody>
			</table>
		<?php endif; ?>
	<?php endif;?>

	<?php if (isset($_GET['cex'])): ?>
		<?php
			$query_cex = "SELECT * FROM list
							WHERE workshop_num = '".$_GET['cex']."' ORDER BY chief DESC";
			$res_cex = mysqli_query($link, $query_cex);
			$query_cex_name = "SELECT name FROM tree
								WHERE workshop = ".$_GET['cex'];
			$res_cex_name = mysqli_query($link, $query_cex_name);
			$row_cex_name = mysqli_fetch_assoc($res_cex_name);
		?>
		<?php if (mysqli_num_rows($res_cex) > 0): ?>
			<h2><?php echo $_GET['cex']." - ".$row_cex_name['name']; ?></h2>
			<table>
				<thead>
					<tr>
						<th>ФИО</th>
						<th>Должность</th>
						<th>Телефон</th>
					</tr>
				</thead>
				<tbody>
				<?php while ($row_cex = mysqli_fetch_assoc($res_cex)): ?>
					<?php
						if (strlen($row_cex['phone_num']) == 9)
						{
							$num = substr($row_cex['phone_num'], 4);
						} else
						{
							$num = $row_cex['phone_num'];
						}
					?>
					<tr>
						<td><?php echo $row_cex['fio']; ?></td>
						<td><?php echo $row_cex['post']; ?></td>
						<td>
						<?php 
							$phones = explode(",", $num);
							foreach ($phones as $phone)
							{
								echo $phone."&nbsp;<br>";
							}
						?>	
						</td>
					</tr>
				<?php endwhile;?>
				</tbody>
			</table>
		<?php endif; ?>
	<?php endif;?>
</div>
</body>
</html>