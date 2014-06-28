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
		<?php
			if (isset($_POST['class'])){
				echo "<p>Hello</p>";
				$class = $_POST['class'];
				$sql = "INSERT INTO students.class (`Description`) VALUES ('".$class."');";
				echo $sql;
				$query = mysql_query($sql, $connection) or die(mysql_errno());
			}			
			$query = mysql_query("SELECT * FROM class");
			echo "<ul>";
			while($array = mysql_fetch_array($query)) {
				echo "<li> ".$array[1]." </li>";
			}
			echo "</ul>";
		?>
	</body>
</html>