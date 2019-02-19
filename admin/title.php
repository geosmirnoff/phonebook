<div class="main">
	<div class="titles">
		<div class="title">
			<?php echo $title; ?>
		</div>
		<div class="exit">
			<form method="POST">
				<button type="submit" name="exit" class="my-btn">Выход</button>
			</form>
		</div>
		<?php
			if (isset($_POST['exit']))
			{
				session_destroy();
				header('location: ../sign-in.php');
			}
		?>
	</div>