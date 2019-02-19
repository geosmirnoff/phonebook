<?php
$title = "Редактирование подразделения";
require_once('header.php');
require_once('nav.php');
?>
<?php if (isset($_SESSION['auth']) && $_SESSION['rights'] == 10): ?>
<?php
	$query = "SELECT * FROM tree WHERE id = '".$_GET['id']."'";
	$res = mysqli_query($link, $query);
	if (mysqli_num_rows($res) > 0)
	{
		$row = mysqli_fetch_assoc($res);
	}
	require_once('title.php');
?>
<div class="content">
<form method="POST" id="add_rec" action="script/edit_workshop.php">
	<div class="row">
		<div class="two columns">
			<label>Код:</label>
			<input class="u-full-width" type="text" name="workshop" value="<?=$row['workshop']; ?>"><br><br>
		</div>
	</div>
	<div class="row">
		<div class="six columns">
			<label>Наименование:</label>
			<input class="u-full-width" type="text" name="name" value="<?=$row['name']; ?>"><br><br>
		</div>
	</div>
	<input type="hidden" name="id" value=<?=$row['id']; ?>>
	<?php if (isset($_GET['search'])): ?>
		<input type="hidden" name="search" value=<?=$_GET['search']; ?>>
	<?php endif; ?>
	<button class="my-btn" type="submit" name="btn">Редактировать</button>
</form>
</div>
</div>
<?php require_once('footer.php'); ?>
<?php else: ?>
	<?php header('location: ../sign-in.php'); ?>
<?php endif; ?>