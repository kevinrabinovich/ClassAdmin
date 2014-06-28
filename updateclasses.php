<html>
	<?php
$title = "Updating classes...";
include 'head.php';
if ($_POST) {
	if (isset($_POST['btnDelete'])) {
		$statement1 = "DELETE FROM `students`.`class` WHERE `idClass`=". $_POST['id'] . ";";
		$statement2 = "DELETE FROM `students`.`userclass` WHERE `idClass`=". $_POST['id'] .";";
		$query = mysql_query($statement1) or die(mysql_error());
		$query2 = mysql_query($statement2) or die(mysql_error());
		session_start();
		$_SESSION['deleteSuccess'] = true;
		$_SESSION['deletedRow'] = $_POST['id'];
	}
	else {
		$query = mysql_query("UPDATE `students`.`class` SET `Professor`='".$_POST['newProfessor']."' WHERE `idClass`='" . $_POST['id'] . "';") or die(mysql_error());
		session_start();
		$_SESSION['updateSuccess'] = true;
		$_SESSION['updatedRow'] = $_POST['id'];
	}
	header("Location: classes.php");
}
else {
	//You typed "updateclasses.php" into the address bar.
	header("Location: classes.php");
}
	?>
</html>