<html>
	<head>
		
	</head>
	<body>
		<?php 
		$connection = mysql_connect("localhost", "root", "MyNewPass");
			$db = mysql_select_db("students", $connection);
			$user = "";
			$query = mysql_query("select users.userid, class.description from users
			join userclass on users.idUsers = userClass.idUser
			join class on userClass.idClass = class.idClass;");
			echo "<table>";
			while($new = mysql_fetch_array($query)) {
				echo "<tr>";
				if ($user != $new[0]) {
					echo "<td>" . $new[0] . "</td>";
				} else {
					echo "<td> </td>";
				}
				echo "<td>" . $new[1] . "</td>";
				echo "</tr>";
				$user = $new[0];
			}
			echo "</table>"
			?>
	</body>
</html>