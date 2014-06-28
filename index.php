<html>
	<?php
$title = 'Login';
include 'head.php';
session_start();
if (isset($_SESSION['loggedInUser'])) {
	header('Location: classes.php');
}
	?>
	<body>
		<div class="container" style="margin: 0 auto; width: 50%">
			<h1>
				<div class="page-header">
					<?php echo $title; ?>
				</div>
			</h1>
			<?php
if (isset($_SESSION['failedLogin'])) {
	echo "<div class='alert alert-danger'>Check your login information!</div>";
}
			?>
			<form method="post" action="classes.php" class="form-horizontal">
				<input type="text" class="form-control input-lg" name="userForm" placeholder="Username" required autofocus>
				<br>
				<input type="password" class="form-control input-lg" name="passwordForm" placeholder="Password" required>
				<br>
				<button class="btn btn-primary btn-lg btn-block" type="submit">Sign In</button>
			</form>
		</div>
	</body>
</html>