<html>
	<?php
$title = "Adding classes...";
include 'head.php';
if ($_POST AND isset($_POST['btnAdd'])) { //Did you come here from classes.php?
		$statement = "INSERT INTO `students`.`class` (`Description`, `Professor`) VALUES ('" . $_POST['newClass'] . "', '" . $_POST['newProf'] . "');";
		$query = mysql_query($statement) or die(mysql_error());
		session_start();
		$_SESSION['AddSuccess'] = true;
		$_SESSION['AddedRow'] = $_POST['newClass'];
	header("Location: everyone.php");
}
else {
	
	header("Location: classes.php");
}
	?>
</html>