<?php
session_start();
/*
 * Wendy Thach
 * Cse451
 * Create db, table, and load data
 *
 *
 */

$mysqli = new mysqli('campbest.451.csi.miamioh.edu', 'exam1', 'exam1', 'exam1');

if($mysqli -> connect_errno) {
	echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
	exit();
}

function getRecords(){
	global $mysqli;
	try {
		$sql = "SELECT pk,roomid,capacity,status FROM exam1";
		$stmt = $mysqli->prepare($sql);
	} catch (Exception $e) {
		die("Invalid prepare");
	}
	//$stmt->bind_param("isis", $pk, $roomid, $capacity, $status);
	if (!$stmt->execute()) {
		die("Error on execute");
	}
	if (!$stmt->bind_result($pk, $roomid, $capacity, $status)) {
		die("Error on bind result");
	}
	while ($stmt->fetch()) {
		print "<tr><td>$pk</td><td>$roomid</td><td>$capacity</td><td>$status</td></tr>";                }
	$stmt->close();
}

?>
<!DOCTYPE HTML>
<html lang=en>
<head>
	<meta charset="utf-8">
	<title>Exam 1</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<h1 class="text-center">Exam 1</h1>
		<div class="row">
			<div class="col-lg-12">
				<table class='table'>
				<thead>
					<th>Pk</th><th>RoomID</th><th>Capacity</th><th>Status</th>
				</thead>
				<tbody>
					<?php getRecords();?>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
