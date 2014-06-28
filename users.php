<html>
	<head>
		<?php
$title = "Users";
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
if (isset($_SESSION['deleteSuccess'])) {
	echo "<div class='alert alert-success' style='margin-top: 5%'>User <strong>" . $_SESSION['deletedRow'] . "</strong> has been deleted!</div>";
	unset($_SESSION['deleteSuccess']);
}
if (isset($_SESSION['updateSuccess'])) {
	echo "<div class='alert alert-success' style='margin-top: 1%'><strong>" . $_SESSION['updatedRow'] . "</strong>'s password has been changed!</div>";
	unset($_SESSION['updateSuccess']);
}
if (isset($_SESSION['permSuccess'])) {
	echo "<div class='alert alert-success' style='margin-top: 1%'><strong>" . $_SESSION['updatedRow'] . "</strong>'s role has been changed!</div>";
	unset($_SESSION['permSuccess']);
}
if (isset($_SESSION['AddSuccess'])) {
	echo "<div class='alert alert-success' style='margin-top: 1%'>User <strong>" . $_SESSION['updatedRow'] . "</strong> has been added!</div>";
	unset($_SESSION['AddSuccess']);
}
$allUsers= mysql_query("select * from users");
echo "<h2>All users:</h2>";
echo "<table class='table table-hover'>";
echo "<thead><tr><th>User ID</th><th>Username</th><th>Password</th><th>Admin?</th><th></th></tr></thead><tbody>";
while($new = mysql_fetch_array($allUsers)) {
	echo "<form action='updateusers.php' method='post'><tr class='";
	if (isset($_SESSION['updatedRow']) AND $new[1] == $_SESSION['updatedRow']) {
		echo " success'>";
		unset($_SESSION['updatedRow']);
	}
	elseif ($new[3] == 1) {
		echo "info'>";
	}
	else {
		echo "'>";
	}
	echo "<td style='width:7%'>" . $new[0] . "</td>";
	echo "<td style='width:25%'>" . $new[1] . "<input type='hidden' value=" . $new[0] . " name='id'>" . "<input type='hidden' value=" . $new[1] . " name='username'>" . "</td>";
	echo "<td>" . "<div class='input-group'><input type='password' value=" . $new[2] . " class='form-control' " . "OnClick=" . 'this.type=' . "'". "text" . "' OnBlur=" . 'this.type=' . "'". "password" . "' name='newPassword'><span class='input-group-btn'><button name='btnPassword' class='btn btn-warning' type='submit'>Change Password</button></span></div>" . "</td>";
	echo "<td style='width:20%;text-align:center;vertical-align:middle;'><input type='checkbox' style='margin: 0 auto;'";
	if ($new[3] == 1) {
		echo " checked ";
	}
//	echo "OnClick=" . 'this.form.submit()' . " name='boxAdmin'></td>"; would be super cool, but it took me too long to implement. (You'd have to comment line 80 for it to work properly)
	echo "disabled></td>";
	echo "<td style='width:23%'><input type='submit' value='Delete' name='btnDelete' class='btn btn-danger btn-block'></td></tr></form>";
}
echo "</tbody></table>";
$allUsers= mysql_query("select * from users");
echo "<h2>Change a user's roles:</h2>";
echo "<h3 style='display:inline'>Pick a user: </h3>";
echo "<form action='updateusers.php' class='form-inline form-horizontal' style='display:inline;' method='POST'>";
echo "<select name='listOfUsers' class='form-control' style='width:20%; display:inline'>";
while($new = mysql_fetch_array($allUsers)) {
	echo "<option value='" . $new[1] . "'>" . $new[1] . "</option>";
}
echo "</select>";
echo "<h3 style='display:inline'> ...and their new role: </h3>";
$allClasses = mysql_query("select class.idClass, class.description from class;");
echo "<select name='listOfPerms' class='form-control' style='width:20%; display:inline'>";
echo "<option value='0'>Student</option>" . "<option value='1'>Admin</option>";
echo "</select>";
echo "<input type='submit' name='btnPerms' style='width: 243px; display: inline; margin-right: 8px;' class='btn btn-primary pull-right' value='Update'>";
echo "</form>";

echo '<h2>Add a user:</h2>';
echo "<h3 style='display:inline'>Type the user's name: </h3>";
echo "<form action='updateusers.php' class='form-inline form-horizontal' style='display:inline;' method='POST'>";
echo '<input type="text" class="form-control" name="newUser" required>';
echo "<h3 style='display:inline'> ...and a new password: </h3>";
echo '<input type="text" class="form-control" name="newPass" required>';
echo "<input type='submit' style='width: 243px; display: inline; margin-right: 8px;' class='btn btn-primary pull-right' name='btnAddUser' value='Add'>";
echo "</form>";

			?>
		</div>
	</body>
</html>