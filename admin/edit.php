<?php
$title = "Редактирование записи";
require_once('header.php');
require_once('nav.php');
?>
<?php if (isset($_SESSION['auth']) && $_SESSION['rights'] == 10): ?>
<?php
	$query = "SELECT * FROM list WHERE id = '".$_GET['id']."'";
	$res = mysqli_query($link, $query);
	if (mysqli_num_rows($res) > 0)
	{
		$row = mysqli_fetch_assoc($res);
	}
	require_once('title.php');
?>
<div class="content">
<form method="POST" id="add_rec" action="script/edit.php">
	<div class="row">
		<div class="two columns">
			<label>Подразделение:</label>
			<input class="u-full-width" type="text" name="workshop" value="<?=$row['workshop_num']; ?>"><br><br>
		</div>
	</div>
	<div class="row">
		<div class="six columns">
			<label>Должность:</label>
			<input class="u-full-width" type="text" name="post" value="<?=$row['post']; ?>"><br><br>
		</div>
	</div>
	<div class="row">
		<label class="example-send-yourself-copy">
			<?php if ($row['chief'] == 1) : ?>
				<input type="checkbox" name="chief" checked="checked">
			<?php else: ?>
				<input type="checkbox" name="chief">
			<?php endif; ?>
			<span class="label-body">Начальник</span>
		</label><br>
	</div>
	<div class="row">
		<div class="six columns">
			<label>ФИО:</label>
			<input class="u-full-width" type="text" name="fio" value="<?=$row['fio']; ?>"><br><br>
		</div>
	</div>
	<div class="row">
		<div class="two columns">
			<label>Номер телефона</label>
			<input class="u-full-width" type="text" name="phone" value=<?=$row['phone_num'] ?>><br><br>
		</div>
	</div>
	<input type="hidden" name="id" value=<?=$_GET['id']; ?>>
	<input type="hidden" name="work" value=<?=$_GET['workshop']; ?>>
	<button class="my-btn" type="submit" name="btn">Редактировать</button>
</form>
</div>
</div>
<?php require_once('footer.php'); ?>
<?php else: ?>
	<?php header('location: ../sign-in.php'); ?>
<?php endif; ?>