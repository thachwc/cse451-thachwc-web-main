<?php
session_start();
/*
 * Wendy Thach
 * Cse451
 *
 *
 */
if(!isset($_SESSION['sum'])) {
	$sum = 0;
}
else {
	$sum = $_SESSION['sum'];
}

function getRequest($name) {
	if(isset($_REQUEST[$name])) {
		return $_REQUEST[$name];
	}
	else {
		return "";
	}
}

$numIn = getRequest("num");

if ($numIn != "") 
{
	$num = htmlspecialchars($numIn);
	if(!is_numeric($num)) {
//		error_log("Inputed string not int value");
		die ("invalid input not a number");
	}
	$sum += $num;
	$_SESSION['sum'] = $sum;
	header("location: page5.php");
	exit;
}

?>
<!DOCTYPE HTML>
<html lang=en>
<head>
	<meta charset="utf-8">
	<title>Exam1</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body>
	<form method="post">
		<input type='text' name='num'>
		<input type="submit">
	</form>
	<?php print $sum;?>
</body>
</html>
