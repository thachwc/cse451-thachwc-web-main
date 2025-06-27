<?php
session_start();
/*
 * Wendy Thach
 * Cse451
 *
 */

function getRequest($name) {
	if(isset($_REQUEST[$name])) {
		return $_REQUEST[$name];
	}
	else {
		return 0;
	}
}
$a = getRequest("a");
$b = getRequest("b");
$c = getRequest("c");
$_SESSION['a'] = $a;
$_SESSION['b'] = $b;
$_SESSION['c'] = $c;
$ans = $a + $b * $c;

?>
<!DOCTYPE HTML>
<html lang=en>
<head>
	<meta charset="utf-8">
	<title>Page3</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body>
	<div class="container">
	<div class="text-center">
		<p>Please enter a number in each entry</p>
		<form method="post">
			<label>a:</label>
			<input type="number" name="a" value="<?php print $a;?>"><br>
			<label>b:</label>
			<input type="number" name="b" value="<?php print $b;?>"><br>
			<label>c:</label>
			<input type="number" name="c" value="<?php print $c;?>"><br>
			<input type="submit">
		</form>
		<h2><?php echo $ans;?></h2>
	</div>
	</div>
</body>
</html>
