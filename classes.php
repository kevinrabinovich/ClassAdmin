<html>
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
	<body>
		<div class="container" style="margin: 0 auto; width: 60%">
			<?php
include 'nav.php';
if (isset($_SESSION['updateSuccess'])) {
	echo "<div class='alert alert-success' style='margin-top: 1%'>Class <strong>" . $_SESSION['updatedRow'] . "</strong> has been updated!</div>";
	unset($_SESSION['updateSuccess']);
}
if (isset($_SESSION['enrollSuccess'])) {
	echo "<div class='alert alert-success' style='margin-top: 1%'>You've been enrolled in <strong>" . $_SESSION['enrolledClass'] . "!</div>";
	unset($_SESSION['enrollSuccess']);
}
if (isset($_SESSION['enrollUserSuccess'])) {
	echo "<div class='alert alert-success' style='margin-top: 1%'>" . $_SESSION['enrolledUser'] . " has been enrolled in <strong>" . $_SESSION['enrolledClassName'] . "!</div>";
	unset($_SESSION['enrollUserSuccess']);
}
if (isset($_SESSION['enrollUserFailed'])) {
	echo "<div class='alert alert-info' style='margin-top: 1%'><strong>" . $_SESSION['enrolledUser'] . "</strong> was already enrolled in <strong>" . $_SESSION['enrolledClass'] . "!</div>";
	unset($_SESSION['enrollUserFailed']);
}
if (isset($_SESSION['deleteSuccess'])) {
	echo "<div class='alert alert-success' style='margin-top: 1%'>Class <strong>" . $_SESSION['deletedRow'] . "</strong> has been deleted!</div>";
	unset($_SESSION['deleteSuccess']);
}
			?>
			<?php
$classes = mysql_query("select class.description, class.professor from users  
			join userclass on users.idUsers = userClass.idUser
			join class on userClass.idClass = class.idClass
			where users.UserID = '".$_SESSION['loggedInUser']."'");
if (mysql_num_rows($classes) !== 0) {
	echo '<h2>Your classes:</h2>';
	echo "<table class='table'>";
	echo "<thead><tr><th>Class Descriptions</th><th>Professors</th></tr></thead>";
	while($new = mysql_fetch_array($classes)) {
		echo "<tbody><tr ";
		if (isset($_SESSION['enrolledClass']) AND ($new[0] == $_SESSION['enrolledClass'])) {
			echo "class='success'";
			unset($_SESSION['enrolledClass']);
		}
		echo ">";
		echo "<td>" . $new[0] . "</td>";
		echo "<td>" . $new[1] . "</td>";
		echo "</tr>";
	}
	echo "</tbody></table>";			
}
else {
	echo "<h2>You aren't enrolled in any classes. :( Check out the <a href='enroll.php'>Enroll page</a>!</h2>";
}
			?>
			<?php
if (isset($_SESSION['isAdmin'])) {
	$allClasses = mysql_query("select class.idClass, class.description, class.professor from class");
	echo "<h2>All classes:</h2>";
	echo "<table class='table table-hover'>";
	echo "<thead><tr><th>Class ID</th><th>Class Name</th><th>Professor Name</th></tr></thead>";
	while($new = mysql_fetch_array($allClasses)) {
		echo "<tbody><tr ";
		if (isset($_SESSION['updatedRow']) AND ($new[0] == $_SESSION['updatedRow'])) {
			echo "class='success'";
			unset($_SESSION['updatedRow']);
		}
		echo "><form action='updateclasses.php' method='POST'>";
		echo "<td style='width:8%'>" . $new[0] . "<input type='hidden' value=" . $new[0] . " name='id'>" . "</td>";
		echo "<td style='width:30%'>" . $new[1] . "<input type='hidden' value=" . $new[1] . " name='className'>" . "</td>";
		echo "<td>" . "<div class='input-group'><input class='form-control' type='text' value=". $new[2] ." name='newProfessor'><span class='input-group-btn'><button class='btn btn-warning' type='submit'>Update</button></span></div>" . "</td>";
		echo "<td style='width:23%'><input type='submit' name='btnDelete' value='Delete' style='width:100%' class='btn btn-danger'></td></form></tr>";
	}
	echo "</tbody></table>";
	echo "<h2>Enroll another user in a class:</h2>";
	echo "<h3 style='display:inline'>Pick a user: </h3>";
	echo "<form action='enrollauser.php' class='form-inline form-horizontal' style='display:inline;' method='POST'>";

	$allClasses = mysql_query("SELECT * FROM students.users;");
	echo "<select name='listOfUsers' class='form-control' style='width:20%; display:inline'>";
	while($new = mysql_fetch_array($allClasses)) {
		echo "<option value='" . $new[0] . "'>" . $new[1] . "</option>";
	}
	echo "</select>";
	echo "<h3 style='display:inline'> ...and a class: </h3>";
	$allClasses = mysql_query("select class.idClass, class.description from class;");
	echo "<select name='listOfClasses' class='form-control' style='width:20%; display:inline'>";
	while($new = mysql_fetch_array($allClasses)) {
		echo "<option value='" . $new[0] . "'>" . $new[1] . "</option>";
	}
	echo "</select>";
	echo "<input type='submit' style='width: 31%; display: inline; margin-right: 8px;' class='btn btn-primary pull-right' value='Enroll'>";
	echo "</form><br>";
}
			?>
		</div>
	</body>
</html>