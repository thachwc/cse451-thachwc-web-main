<?php
session_start();
/*
 * Wendy Thach
 * CSE451
 *
 */
function getRequest($name) {
	if(isset($_REQUEST[$name])) {
		return $_REQUEST[$name];
	}
	else {
		return "";
	}
}
function getRecords($num){
	for($x = 0; $x < $num; $x++){
		$temp = rand(1, 100);
		print "<tr><td>$temp</td></tr>";
	}
}


?>

<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset=utf-8>
		<title>Page1</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	      	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.tstrap.min.css">
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/nptrap.bundle.min.js"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	</head>
	<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<table class='table'>
					<?php getRecords($_GET["num"]);?>
				</table>
			</div>
		</div>
	</div>
	</body>
</html>
