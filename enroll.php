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
		<div class="container" style="width: 60%; margin: 0 auto;">
			<?php
include 'nav.php';
if (isset($_SESSION['updateSuccess'])) {
	echo "<div class='alert alert-success' style='margin-top: 1%'>Class <strong>" . $_SESSION['updatedRow'] . "</strong> has been updated!</div>";
	unset($_SESSION['updateSuccess']);
}
if (isset($_SESSION['enrollSuccess'])) {
	echo "<div class='alert alert-success' style='margin-top: 1%'>You've been enrolled in <strong>" . $_SESSION['updatedRow'] . "!</div>";
	unset($_SESSION['enrollSuccess']);
}
if (isset($_SESSION['enrollUserSuccess'])) {
	echo "<div class='alert alert-success' style='margin-top: 1%'>The user has been enrolled in class #<strong>" . $_SESSION['updatedRow'] . "!</div>";
	unset($_SESSION['enrollUserSuccess']);
}
if (isset($_SESSION['unenrollUserSuccess'])) {
	echo "<div class='alert alert-success' style='margin-top: 1%'>The user has been unenrolled from class #<strong>" . $_SESSION['updatedRow'] . "!</div>";
	unset($_SESSION['unenrollUserSuccess']);
}
			?>
			<h2>Enroll yourself in a class:</h2>
			<?php
$enrollableClasses = mysql_query("select class.description, class.professor, class.idClass from class");
$currentClasses = mysql_query("select class.idClass from users  
			join userclass on users.idUsers = userClass.idUser
			join class on userClass.idClass = class.idClass
			where users.UserID = '".$_SESSION['loggedInUser']."'");
echo "<table class='table table-hover'>";
echo "<thead><tr><th>Class Descriptions</th><th>Professors</th></tr></thead>";
echo "<tbody><tr>";
while($new = mysql_fetch_array($enrollableClasses)) {
	echo "<form action='enrollyourself.php' method='post'>";
	echo "<td>" . $new[0] . "<input type='hidden' value=" . $new[2] . " name='enrollClassId'>" . "<input type='hidden' value=" . $new[0] . " name='enrollClassName'>" . "</td>";
	echo "<td>" . $new[1] . "</td>";
	echo "<td><input type='submit' class='btn btn-block btn-";
	$alreadyEnrolled = false;
	$isEnrolled = mysql_query("select * from userclass where idUser = '" . $_SESSION['loggedInUserID'] . "' AND idClass = " . $new[2] . ";");
	$isEnrolledRow = mysql_fetch_array($isEnrolled);
	if (!empty($isEnrolledRow['idUser']) AND !empty($isEnrolledRow['idClass'])) {
		$alreadyEnrolled = true;
	}
	if ($alreadyEnrolled) {
		echo "disabled' value='Already enrolled!' disabled>";
		$alreadyEnrolled = false;
	}
	else {
		echo "primary' value='Enroll' >";
	}
	echo "</td>";
	echo "</form></tr>";
}
echo "</tbody></table>";
if (isset($_SESSION['isAdmin'])) {
	echo "<h2><form action='unenroll.php' method='post' class='form-horizontal'>Edit ";
	echo "<select name='listOfUsers' onchange='this.form.submit()' class='form-control' style='width:20%; display:inline'>";
	$allClasses = mysql_query("SELECT * FROM students.users;");
	session_start();
	if (!isset($_SESSION['userClasses'])) {
		$_SESSION['userClasses'] = $_SESSION['loggedInUserID'];
	}
	while($new = mysql_fetch_array($allClasses)) {
		echo "<option value='" . $new[0] . "' ";
		if ($_SESSION['userClasses'] == $new[0]) {
			echo "selected>";
		}
		else {
			echo ">";
		}
		echo $new[1] . "</option>";
	}
	echo "</select>";
	echo " 's classes:</form></h2>";
	$enrollableClasses = mysql_query("select class.description, class.professor, class.idClass from class");
	$currentClasses = mysql_query("select class.idClass from users  
			join userclass on users.idUsers = userClass.idUser
			join class on userClass.idClass = class.idClass
			where users.UserID = '".$_SESSION['userClasses']."'");
	echo "<table class='table table-hover'>";
	echo "<thead><tr><th>Class Descriptions</th><th>Professors</th></tr></thead>";
	while($new = mysql_fetch_array($enrollableClasses)) {
		echo "<tbody><tr ";
		if (isset($_SESSION['updatedRow']) AND ($new[2] == $_SESSION['updatedRow'])) {
			echo "class='success'";
			unset($_SESSION['updatedRow']);
		}
		echo ">";
		echo "<form action='unenroll.php' method='post'>";
		echo "<td>" . $new[0] . "<input type='hidden' value=" . $new[2] . " name='enrollClassId'>" . "<input type='hidden' value=" . $new[0] . " name='enrollClassName'>" . "</td>";
		echo "<td>" . $new[1] . "</td>";
		echo "<td><input type='submit' class='btn btn-block btn-";
		$alreadyEnrolled = false;
		$isEnrolled = mysql_query("select * from userclass where idUser = '" . $_SESSION['userClasses'] . "' AND idClass = " . $new[2] . ";");
		$isEnrolledRow = mysql_fetch_array($isEnrolled);
		if (!empty($isEnrolledRow['idUser']) AND !empty($isEnrolledRow['idClass'])) {
			$alreadyEnrolled = true;
		}
		if ($alreadyEnrolled) {
			echo "danger' value='Unenroll' name='btnUnenroll'>";
			$alreadyEnrolled = false;
		}
		else {
			echo "primary' value='Enroll' name='btnEnroll'>";
		}
		echo "</td>";
		echo "</form></tr>";
	}
	echo "</tbody></table>";
}
unset($_SESSION['updatedRow']);?>
		</div>
	</body>	
</html>