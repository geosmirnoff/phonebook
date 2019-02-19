<?php
	$title = "Список телефонов сотрудников";
	require_once('header.php');
	require_once('nav.php');
?>
<?php if (isset($_SESSION['auth']) && $_SESSION['rights'] == 10): ?>
	<?php require_once('title.php'); ?>
		<div class="content"><br>
		<?php
			$query = "SELECT id, fio, workshop_num, post, phone_num
						FROM list";
			$res = mysqli_query($link, $query);
			$workshop = "SELECT workshop 
							FROM tree 
								ORDER BY workshop";
			$resw = mysqli_query($link, $workshop);
		?>
		<form method="GET">
			<div class="row">
				<div class="three columns">
					<select class="u-full-width" name="filter-work">
						<option disabled selected>Подразделение</option>
					<?php if (mysqli_num_rows($resw) > 0): ?>
						<?php while ($roww = mysqli_fetch_assoc($resw)): ?>
							<?php
								switch ($roww['workshop']{0})
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
								}
								$sel = "selected";
							?>

							<option value="<?=$roww['workshop'];?>" 
								<?php 
									if (isset($_GET['filter-work']) && $_GET['filter-work'] == $roww['workshop'])
									{
										echo $sel;
									}
								?>>
								<?php 
									echo $podr.' '.$roww['workshop'];
								?>		
							</option>
						<?php endwhile; ?>
					<?php endif; ?>
					</select>
				</div>
				&nbsp;<button class="my-btn" type="submit">Фильтр</button>
			</div>
		</form>
		<?php if (isset($_GET['filter-work'])): ?>
			<?php
				$filter = "SELECT id, fio, workshop_num, post, phone_num
							FROM list WHERE workshop_num = '".$_GET['filter-work']."'";
				$resf = mysqli_query($link, $filter);
			?>
			<?php if (mysqli_num_rows($resf) > 0) : ?>

				<table class="u-half-width">
				<thead>
					<tr>
						<th>ФИО&nbsp;</th>
						<th>&nbsp;Отдел&nbsp;</th>
						<th>Должность</th>
						<th colspan='3'>&nbsp;Телефон</th>
					</tr>
				</thead>
				<tbody>
				<?php while ($rowf = mysqli_fetch_assoc($resf)) : ?>
					<tr>
						<td><?php echo $rowf['fio']; ?>&nbsp;</td>
						<td>&nbsp;<?php echo $rowf['workshop_num']; ?>&nbsp;</td>
						<td>
						<?php 
							$postlen = explode(" ", $rowf['post']);
							foreach ($postlen as $key => $post) {
								echo $post." ";
								if ($key % 4 == 0 && $key != 0)
								{
									echo "<br>";
								}
							}						
						?>
						</td>
						<?php $phones = explode(",", $rowf['phone_num']); ?>
						<td>
						<?php
							foreach ($phones as $phone)
							{
								echo $phone."&nbsp;<br>";
							}
						?>
						</td>
						<td>&nbsp;<a href="edit.php?id=<?=$rowf['id'];?>&workshop=<?=$_GET['filter-work']?>"><img src="img/edit.png"></a>&nbsp;</td>
						<td>&nbsp;<a href="delete.php?id=<?=$rowf['id']; ?>&workshop=<?=$_GET['filter-work']?>"><img src="img/delete.png"></a>&nbsp;</td>
					</tr>
				<?php endwhile; ?>
				</tbody>
			</table>		
			<?php endif; ?>
		
		<?php endif; ?>
		</div>
	</div>
<?php require_once('footer.php'); ?>
<?php else: ?>
	<?php header('location: ../sign-in.php'); ?>
<?php endif; ?>