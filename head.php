<head>
	<?php
define("server", "localhost");
define("user", "root");
define("pw", "MyNewPass");
define("db", "students");
$connection = mysql_connect(server,user,pw);
$db_select = mysql_select_db(db,$connection);
	?>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<title><?php echo $title; ?></title>
</head>