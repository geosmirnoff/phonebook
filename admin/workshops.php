<?php
	$title = "Список подразделений завода";
	require_once('header.php');
	require_once('nav.php');
?>
<?php if (isset($_SESSION['auth']) && $_SESSION['rights'] == 10): ?>
	<?php require_once('title.php'); ?>
		<div class="content"><br>
		<form method="GET" action="">
			<div class="row">
				<div class="four columns">
					<?php
						$value = "";
						if (isset($_GET['search']))
						{
							$value = $_GET['search'];
						}
					?>
					<input class="u-full-width" name="search" type="text" value="<?=$value;?>">
				</div>
				&nbsp;<button class="my-btn" type="submit">Поиск</button>
			</div>
		</form>
			<table class="u-half-width">
				<thead>
					<tr>
						<th>Код подразделения&nbsp;</th>
						<th colspan='3'>&nbsp;Название</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$where = "";
					if (isset($_GET['search']))
					{
						$search = $_GET['search'];
						$where = " WHERE name LIKE '%$search%' OR workshop LIKE '%$search%'";
					}
					$query = "SELECT id, workshop, name
								FROM tree".$where." ORDER BY workshop";
					$res = mysqli_query($link, $query);
				?>
				<?php while ($row = mysqli_fetch_assoc($res)): ?>
					<tr>
						<td><?php echo $row['workshop']; ?></td>
						<td><?php echo $row['name']; ?></td>
						<td>&nbsp;<a href="edit_workshop.php?id=<?=$row['id'];?>
						<?php
							if (isset($_GET['search']))
							{
								echo "&search=".$search;
							}
						?>
						"><img src="img/edit.png"></a>&nbsp;</td>
						<td>&nbsp;<a href="delete_workshop.php?id=<?=$row['id']; ?>"><img src="img/delete.png"></a>&nbsp;</td>
					</tr>
				<?php endwhile; ?>
				</tbody>
			</table>		
		</div>
	</div>
<?php require_once('footer.php'); ?>
<?php else: ?>
	<?php header('location: ../sign-in.php'); ?>
<?php endif; ?>