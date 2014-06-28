<?php
$title = "Updating classes...";
include 'head.php';
if ($_POST) {
	$queryString = "select * from userclass WHERE userclass.idUser = ".$_POST['listOfUsers']." AND userclass.idClass = " . $_POST['listOfClasses'];
	$verifyQuery = mysql_query($queryString) or die(mysql_error());
	$verifyQueryArray = mysql_fetch_array($verifyQuery);
	session_start();
	if (!empty($verifyQueryArray[0]) AND !empty($verifyQueryArray[1])) {
		$_SESSION['enrollUserFailed'] = true;
	}
	else {
		$query = mysql_query("INSERT INTO `students`.`userclass` (`idUser`, `idClass`) VALUES (". $_POST['listOfUsers']. "," . $_POST['listOfClasses'] .");") or die(mysql_error());
	$_SESSION['enrollUserSuccess'] = true;
	}

	$userNameQuery = mysql_query("SELECT users.UserID FROM users WHERE idUsers =". $_POST['listOfUsers']) or die(mysql_error());
	$classNameQuery = mysql_query("SELECT class.Description FROM class WHERE idClass =". $_POST['listOfClasses']) or die(mysql_error());
	$new = mysql_fetch_array($userNameQuery);
	$new2 = mysql_fetch_array($classNameQuery);
	$_SESSION['enrolledUser'] = $new[0];
	$_SESSION['enrolledClassName'] = $new2[0];
	header("Location: classes.php");
}
else {
	header("Location: classes.php");
}
?>