<html>
	<?php
$title = "Updating classes...";
include 'head.php';
if ($_POST) {
	if (isset($_POST['btnDelete'])) {
		$statement1 = "DELETE FROM `students`.`users` WHERE `idUsers`=". $_POST['id'] . ";";
		$query = mysql_query($statement1) or die(mysql_error());
		session_start();
		$_SESSION['deleteSuccess'] = true;
		$_SESSION['deletedRow'] = $_POST['username'];
	}
	elseif (isset($_POST['btnPassword'])) {
		$query = mysql_query("UPDATE `students`.`users` SET `Password`='".$_POST['newPassword']."' WHERE `idUsers`='" . $_POST['id'] . "';") or die(mysql_error());
		session_start();
		$_SESSION['updateSuccess'] = true;
		$_SESSION['updatedRow'] = $_POST['username'];
	}
	elseif (isset($_POST['btnPerms'])) {
		$statement1 = "UPDATE `students`.`users` SET `isAdmin`='".$_POST['listOfPerms']."' WHERE `UserID`='" . $_POST['listOfUsers'] . "';";
		$query = mysql_query($statement1) or die(mysql_error());
		session_start();
		$_SESSION['permSuccess'] = true;
		$_SESSION['updatedRow'] = $_POST['listOfUsers'];
	}
	elseif (isset($_POST['btnAddUser'])) {
		$statement = "INSERT INTO `students`.`users` (`UserID`, `Password`) VALUES ('" . $_POST['newUser'] . "', '" . $_POST['newPass'] . "');";
		$query = mysql_query($statement) or die(mysql_error());
		session_start();
		$_SESSION['AddSuccess'] = true;
		$_SESSION['updatedRow'] = $_POST['newUser'];
		header("Location: users.php");
	}
	header("Location: users.php");
}
else {
	header("Location: classes.php");
}
	?>
</html>