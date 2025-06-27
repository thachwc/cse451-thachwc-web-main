<?php
$mysqli = new mysqli("campbest.451.csi.miamioh.edu","exam2","exam2","exam2");
if ($mysqli -> connect_errno) {
	  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
	    exit();
}
$result = $mysqli -> query("SELECT name FROM exam2");
$a = array();
while($row = mysqli_fetch_assoc($result)) {
	$a[] = $row;
}
echo json_encode($a, JSON_PRETTY_PRINT);

$mysqli -> close();
?>
