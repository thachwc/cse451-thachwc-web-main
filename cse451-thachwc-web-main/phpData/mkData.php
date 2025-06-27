<?php
/*
 * Wendy Thach
 * Cse451
 * Create db, table, and load data
 * Needs passwd.php
 * $user=
 * $pwd=
 * $host=
 * $db=
 */
if(!defined('STDIN'))
	die("Not running from CLI");

require("./passwd.php");
$mysqli = new mysqli("localhost", $user, $pwd, "mysql");

if($mysqli -> connect_errno) {
	echo "Failed to connect to MySql: " . $mysqli -> connect_error;
	exit();
}

$sql = "\nCREATE database IF NOT EXISTS anime\n";
echo "Creating anime db\n";
if($mysqli -> query($sql)) {
	echo "OK \n";
}
else {
	echo "Create failed";
	die;
}

$mysqli->select_db($db);

$mysqli->query("DROP TABLE IF EXISTS anime");

$sql = "CREATE TABLE `anime` (
	`pk` INT NOT NULL AUTO_INCREMENT,
	`title` TEXT,
	`episodes` INT DEFAULT '0',
	`studios` TEXT,
	`genres` TEXT,
	`description` TEXT,
	PRIMARY KEY (`pk`)
);";
echo "Creating table\n";
if($mysqli -> query($sql)) {
	echo "OK\n";
}
else {
	echo "Create failed";
	die;
}

$handle = fopen("dataanime.csv", "r");
if($handle == false) {
	die("Failed to open");
}
$stmt = $mysqli->prepare("INSERT INTO anime.anime (title,episodes,studios,genres,description) VALUES (?,?,?,?,?)");
$stmt->bind_param("sisss", $title, $epi, $stu, $gen, $des);
while(($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	$title = $data[0];
	$epi = $data[2];
	$stu = $data[10];
	$gen = $data[12];
	$des = $data[19];
	if($stmt->execute()) {
		print "Row $title added\n";
	}
	else {
		die("Error on row $title");
	}
}
$stmt->close();
fclose($handle);
$mysqli -> close();

?>
