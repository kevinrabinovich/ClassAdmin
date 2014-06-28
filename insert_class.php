<?php
if($_SESSION['isAdmin'] = 0) {
header('Location: userandclasses.php');
}
?>	
	<html>
	<head>
		
		<?php
define("server", "localhost");
define("user", "root");
define("pw", "MyNewPass");
define("db", "students");
$connection = mysql_connect(server,user,pw);
$db_select = mysql_select_db(db,$connection);
		?>
	</head>
	<body>
	<form action="userandclasses.php">
		Class: <input type="text" name="class">
		</br><input type="submit" name="insert">
	</form>
<?php
	if (isset($_POST['class'])){
	$class = $_POST['class'];
	$sql = "INSERT INTO students.class ('Description') VALUES ('".$class."');";
	}
	?>
	</body>
	</html>
