<html>
	<?php
	$title = "Enrolling you...";
	include 'head.php';
	if ($_POST) {
			session_start();
			$query = mysql_query("INSERT INTO `students`.`userclass` (`idUser`, `idClass`) VALUES (". $_SESSION['loggedInUserID'] . "," . $_POST['enrollClassId'] . "
)") or die(mysql_error());
			$_SESSION['enrollSuccess'] = true;
			$_SESSION['enrolledClass'] = $_POST['enrollClassName'];
			header("Location: classes.php");
	}
	else {
		header("Location: index.php");
	}
	?>
</html>