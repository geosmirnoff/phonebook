<?php
$title = "Добавление записи в справочник";
require_once('header.php');
require_once('nav.php');

?>
<?php if (isset($_SESSION['auth']) && $_SESSION['rights'] == 10): ?>
	<?php require_once('title.php'); ?>
<div class="content">
<form method="POST" id="add_rec" action="script/add_rec.php">
	<div class="row">
		<div class="three columns filter">
			<label>Подразделение:</label>
			<select class="u-full-width" name="workshop">
			<?php
				$query = "SELECT workshop, name
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
						<option value="<?=$row['workshop'];?>"><?php echo $podr.' '.$row['workshop']; ?></option>
					<?php endwhile; ?>
				<?php endif; ?>
			</select><br><br>
		</div>
	</div>
	<div class="row">
		<div class="five columns">
			<label>Должность:</label>
			<input class="u-full-width" type="text" name="post" autocomplete="off"><br><br>
		</div>
	</div>
<div class="row">
		<label class="example-send-yourself-copy">
			<input type="checkbox" name="chief">
			<span class="label-body">Начальник</span>
		</label><br>
	</div>
	<div class="row">
		<div class="five columns">
			<label>ФИО:</label>
			<input class="u-full-width" type="text" name="fio" autocomplete="off"><br><br>
		</div>
	</div>
	<div class="row">
		<div class="four columns">
			<label>Номер телефона</label>
			<input class="u-full-width" type="text" name="phone" autocomplete="off" id="phone">
		</div>
	</div>
	<div id="advice">Вводите номера через запятую без пробелов (26-14,26-15)</div><br>
	<button class="my-btn" type="submit">Добавить</button>
</form>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script>
	document.getElementById('phone').onfocus = function() {
		document.getElementById('advice').style.visibility = "visible";
	}
	document.getElementById('phone').onblur = function() {
		document.getElementById('advice').style.visibility = "hidden";
	}
</script>
<?php require_once('footer.php'); ?>
<?php else: ?>
	<?php header('location: ../sign-in.php'); ?>
<?php endif; ?>