<html>
	<?php
$title = "Updating classes...";
include 'head.php';
if ($_POST) {
	session_start();
	if (isset($_POST['listOfUsers'])) {
		$_SESSION['userClasses'] = $_POST['listOfUsers'];
		header("Location: enroll.php");
	}
	elseif (isset($_POST['btnEnroll'])) {
		$query = mysql_query("INSERT INTO `students`.`userclass` (`idUser`, `idClass`) VALUES (". $_SESSION['userClasses'] . "," . $_POST['enrollClassId'] .");") or die(mysql_error());
		$_SESSION['enrollUserSuccess'] = true;
		$_SESSION['updatedRow'] = $_POST['enrollClassId'];
	}
	elseif (isset($_POST['btnUnenroll'])) {
		$query = mysql_query("DELETE FROM `students`.`userclass` WHERE `idUser`=". $_SESSION['userClasses'] . " AND idClass = '" . $_POST['enrollClassId'] . "';") or die(mysql_error());
		session_start();
		$_SESSION['unenrollUserSuccess'] = true;
		$_SESSION['updatedRow'] = $_POST['enrollClassId'];
	}
	header("Location: enroll.php");
}
else {
	header("Location: classes.php");
}
	?>
</html>