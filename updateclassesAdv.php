<html>
	<?php
$title = "Updating classes...";
include 'head.php';
if ($_POST AND isset($_POST['btnDelete'])) {
		$statement1 = "DELETE FROM `students`.`class` WHERE `idClass`=". $_POST['id'] . ";";
		$statement2 = "DELETE FROM `students`.`userclass` WHERE `idClass`=". $_POST['id'] .";";
		$query = mysql_query($statement1) or die(mysql_error());
		$query2 = mysql_query($statement2) or die(mysql_error());
		session_start();
		$_SESSION['deletedRow'] = $_POST['id'];
		header("Location: everyone.php");
}
elseif ($_POST AND (isset($_POST['btnUpdateProf']))) {
	$query = mysql_query("UPDATE `students`.`class` SET `Professor`='".$_POST['newProfName']."' WHERE `idClass`='" . $_POST['id'] . "';") or die(mysql_error());
	session_start();
	$_SESSION['updateSuccess'] = true;
	$_SESSION['updatedRow'] = $_POST['id'];
	$_SESSION['updatedRowProf'] = $_POST['newProfName'];
	header("Location: everyone.php");
}
elseif ($_POST AND (isset($_POST['btnUpdateClass']))) {
	$query = mysql_query("UPDATE `students`.`class` SET `Description`='".$_POST['newClassName']."' WHERE `idClass`='" . $_POST['id'] . "';") or die(mysql_error());
	session_start();
	$_SESSION['updateSuccess'] = true;
	$_SESSION['updatedRow'] = $_POST['id'];
	$_SESSION['updatedRowClass'] = $_POST['newClassName'];
	header("Location: everyone.php");
}
else {
	header("Location: classes.php");
}
	?>
</html>