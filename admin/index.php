<?php
	$title = "Главная";
	require_once('header.php');
	require_once('nav.php');
?>
<?php if (isset($_SESSION['auth']) && $_SESSION['rights'] == 10): ?>
	<?php require_once('title.php'); ?>
		<div class="content">
			<?php echo "Вы вошли как ".$_SESSION['uname']; ?>
		</div>
	</div>
	<?php require_once('footer.php'); ?>
<?php else: ?>
	<?php header('location: ../sign-in.php'); ?>
<?php endif; ?>