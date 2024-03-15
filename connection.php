<html>
<head>
<title>connection</title>
</head>
<body>
<?php
$servername='localhost';
$uname='root';
$pword='';
$db='miniproject';
$conn=mysqli_connect("$servername","$uname","$pword","$db");
if(!$conn)
{
	die("connection failed".mysqli_connect_error());
}
//echo"CONNECTION SUCCESSFULL";
?>
</body>
</html>