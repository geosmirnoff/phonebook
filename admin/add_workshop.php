<?php
$title = "Добавление подразделения";
require_once('header.php');
require_once('nav.php');

?>
<?php if (isset($_SESSION['auth']) && $_SESSION['rights'] == 10): ?>
	<?php require_once('title.php'); ?>
<div class="content">
<form method="POST" id="add_ws" action="script/add_workshop.php">
	<div class="row">
		<div class="two columns">
			<label>Номер:</label>
			<input class="u-full-width" type="text" name="workshop" autocomplete="off"><br><br>
		</div>
	</div>
	<div class="row">
		<div class="five columns">
			<label>Наименование:</label>
			<input class="u-full-width" type="text" name="name" autocomplete="off"><br><br>
		</div>
	</div>
	<div class="row">
		<div class="three columns filter">
			<label>Относится к:</label>
			<select class="u-full-width" name="parent">
			<?php
				$query = "SELECT workshop, name, id
							FROM tree
							ORDER BY workshop";
				$res = mysqli_query($link, $query); ?>
				<?php if (mysqli_num_rows($res) > 0): ?>
					<?php if (isset($_POST['added_workshop'])): ?>
						<option value="<?=$_POST['added_workshop'];?>" selected><?php echo $_POST['added_workshop']; ?></option>
					<?php endif; ?>
					<?php while ($row = mysqli_fetch_assoc($res)): ?>
						<?php
							switch ($row['workshop']{0})
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
						?>
						<option value="<?=$row['id'];?>"><?php echo $podr.' '.$row['workshop']; ?></option>
					<?php endwhile; ?>
				<?php endif; ?>
			</select><br><br>
		</div>
	</div>
	<br>
	<button class="my-btn" type="submit">Добавить</button>
</form>
</div>
</div>
<?php require_once('footer.php'); ?>
<?php else: ?>
	<?php header('location: ../sign-in.php'); ?>
<?php endif; ?>