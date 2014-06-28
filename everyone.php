<html>
	<head>
		<?php
$title = "Classes";
include 'head.php';
session_start();
if ($_POST) {
	if (isset($_POST['btn_logout'])) {
		$_SESSION = array();
		session_destroy();
		header("Location: index.php");
	}
	if (isset($_POST['userForm']) AND isset($_POST['passwordForm'])) {
		if(isset($_POST["userForm"]) ){
			$query = mysql_query("SELECT * FROM users WHERE UserID = '".$_POST["userForm"]."' AND Password = '".$_POST["passwordForm"]."'") or header("Location: index.php");
			$row = mysql_fetch_array($query);
			if (!empty($row['UserID']) AND !empty($row['Password'])) {
				if ($row['isAdmin'] == 1) {
					$_SESSION['isAdmin'] = true;
				}
				$_SESSION['loggedInUser'] = $_POST["userForm"];
				$_SESSION['loggedInUserID'] = $row['idUsers'];
			}
			else {
				$_SESSION['failedLogin'] = true;
				header("Location: index.php");
			}
		}
	}
}
elseif (!isset($_SESSION['loggedInUser']))
{
	header("Location: index.php");
}
		?>
	</head>
	<body>
		<div class="container" style="width: 60%">
			<?php include 'nav.php';
if (isset($_SESSION['AddSuccess'])) {
	echo "<div class='alert alert-success' style='margin-top: 1%'>Class <strong>" . $_SESSION['AddedRow'] . "</strong> has been added!</div>";
	unset($_SESSION['AddSuccess']);
}
if (isset($_SESSION['updatedRowProf'])) {
	echo "<div class='alert alert-success' style='margin-top: 1%'>Professor <strong>" . $_SESSION['updatedRowProf'] . "</strong>'s classes have been updated!</div>";
	unset($_SESSION['updatedRow']);
	unset($_SESSION['updatedRowProf']);
}
if (isset($_SESSION['updatedRowClass'])) {
	echo "<div class='alert alert-success' style='margin-top: 1%'>Class <strong>" . $_SESSION['updatedRowClass'] . "</strong> has been updated!</div>";
	unset($_SESSION['updatedRowClass']);
}
if (isset($_SESSION['deletedRow'])) {
	echo "<div class='alert alert-success' style='margin-top: 1%'>Class <strong>" . $_SESSION['deletedRow'] . "</strong> has been deleted!</div>";
	unset($_SESSION['deletedRow']);
} 
$allClasses = mysql_query("select class.idClass, class.description, class.professor from class");
echo "<h2>All classes:</h2>";
echo '<div class="well"><strong>Remember, you can only update one item at a time!</strong></div>';
echo "<table class='table table-hover'>";
echo "<thead><tr><th>Class ID</th><th>Class Name</th><th>Professor Name</th></tr></thead>";
while($new = mysql_fetch_array($allClasses)) {
	echo "<tbody><tr ";
	if (isset($_SESSION['AddedRow']) AND ($new[1] == $_SESSION['AddedRow'])) {
		echo "class='success'";
		unset($_SESSION['AddedRow']);
	}
	if (isset($_SESSION['updatedRow']) AND ($new[0] == $_SESSION['updatedRow'])) {
		echo "class='success'";
		unset($_SESSION['updatedRow']);
	}
	echo "><form action='updateclassesAdv.php' method='POST'>";
	echo "<td style='width:8%'>" . $new[0] . "<input type='hidden' value=" . $new[0] . " name='id'>" . "</td>";
	echo "<td>" . "<div class='input-group'><input class='form-control' type='text' value=". $new[1] ." name='newClassName'><span class='input-group-btn'><button class='btn btn-warning' name='btnUpdateClass' type='submit'>Update Class</button></span></div>" . "</td>";
	echo "<td>" . "<div class='input-group'><input class='form-control' type='text' value=". $new[2] ." name='newProfName'><span class='input-group-btn'><button class='btn btn-warning' name='btnUpdateProf' type='submit'>Update Professor</button></span></div>" . "</td>";
	echo "<td style='width:23%'><input type='submit' name='btnDelete' value='Delete' style='width:100%' class='btn btn-danger'></td></form></tr>";
}
echo "</tbody></table>";
echo '<h2>Add a class:</h2>';
echo "<h3 style='display:inline'>Type the class name: </h3>";
echo "<form action='addclasses.php' class='form-inline form-horizontal' style='display:inline;' method='POST'>";
echo '<input type="text" class="form-control" name="newClass" required>';
echo "<h3 style='display:inline'> ...and the professor: </h3>";
echo '<input type="text" class="form-control" name="newProf" required>';
echo "<input type='submit' style='width: 243px; display: inline; margin-right: 8px;' class='btn btn-primary pull-right' name='btnAdd' value='Add'>";
echo "</form>";
			?>
		</div>
	</body>
</html>