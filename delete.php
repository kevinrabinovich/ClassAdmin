<html>
	<body>
		<div style="width: 50%; margin: 0 auto;">
		<?php
		$title = "Deleting classes...";
include 'head.php';
	if (isset($_SESSION['deleteSuccess'])) {
	echo "<div class='alert alert-success' style='margin-top: 5%'>Class <strong>" . $_SESSION['deletedRow'] . "</strong> has been deleted!</div>";
	unset($_SESSION['deleteSuccess']);
}
	$allClasses = mysql_query("select class.idClass, class.description, class.professor from class");
	echo "<h2>All classes:</h2>";
	echo "<table class='table table-hover'>";
	echo "<thead><tr><th>Class IDs</th><th>Class Descriptions</th><th>Professors</th></tr></thead>";
	while($new = mysql_fetch_array($allClasses)) {
		echo "<tbody><tr ";
		echo "><form action='deleteclasses.php' method='POST'>";
		echo "<td>" . $new[0] . "<input type='hidden' value=" . $new[0] . " name='id'>" . "</td>";
		echo "<td>" . $new[1] . "<input type='hidden' value=" . $new[1] . " name='className'>" . "</td>";
		echo "<td>" . $new[2] . "</td>";
		echo "<td><input type='submit' value='Delete' style='width:100%' class='btn btn-danger'></td></form>";
		echo "</tr>";
	}
	echo "</tbody></table>";
	?>
	</div>
	</body>
</html>