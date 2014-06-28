<nav class="navbar navbar-default" style="margin-top: 1%">
	<ul class="nav navbar-nav">
		<?php
		if (isset($_SESSION['isAdmin']) AND $_SESSION['isAdmin']) {
			$navElements = ["Home" => "classes.php", "Enroll" => "enroll.php", "Users" => "users.php", "Classes" => "everyone.php"];
		}
		else {
		$navElements = ["Home" => "classes.php", "Enroll" => "enroll.php"];
		}
$currentPage = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
foreach ($navElements as $pageName => $pageURL) {
	if ($currentPage == $pageURL) {
		echo "<li class='active'><a href='" . $pageURL . "'>" . $pageName . "</a></li>";
	}
	else {
		echo "<li><a href='" . $pageURL . "'>" . $pageName . "</a></li>";
	}
}
		?>
	</ul>
	<form action="classes.php" method="POST" class="navbar-form pull-right">
		<button type="submit" class="btn btn-default" name="btn_logout">Log out</button>
	</form>
	<p class="navbar-text pull-right">Welcome,
	<?php
if (isset($_SESSION['isAdmin'])) {
	echo '<span class="label label-primary">' . $_SESSION['loggedInUser'] . '</span>';
}
		else {
			echo $_SESSION['loggedInUser'];
		}
		?>.</p>
</nav>