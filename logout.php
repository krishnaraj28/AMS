<html>
<head>
	<title>logout</title>
</head>
<body>
<?php
session_start();
$_SESSION = array();
session_destroy();
header("Location: login.php"); 
exit();
?>
</body>
</html>