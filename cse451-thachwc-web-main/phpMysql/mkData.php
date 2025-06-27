<?php
/*
 * scott campbell
 * cse451
 * create db, table and load starbucks data
 *
 * needs passwd.php
 * $user=
 * $pwd=
 * $host=
 * $db=
 */
if(!defined('STDIN') ) 
  die ("Not Running from CLI");


require("./passwd.php");
$mysqli = new mysqli("localhost",$user,$pwd,"mysql");

// Check connection
if ($mysqli -> connect_errno) {
	echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
	exit();
}

// Perform query
$sql = "\ncreate database if not exists numbers\n";
echo "Creating numbers db\n";
if ($mysqli -> query($sql)) {
	echo "OK \n";
}
else {
	echo "Create failed";
	die;
}

//change do new db
$mysqli->select_db($db);


// drop table if it exists
$mysqli->query("drop table if exists starbucks");

// create table
$sql = "CREATE TABLE `starbucks` (
	`pk` INT NOT NULL AUTO_INCREMENT,
	`name` TEXT ,
	`calories` INT DEFAULT '0',
	`fat` INT DEFAULT '0',
	`carb` INT DEFAULT '0',
	`fiber` INT default '0',
	`protein` INT default '0',
	`sodium` INT default '0',
	`likes` int default '0',
	PRIMARY KEY (`pk`)
);";
echo "Creating table\n";
if ($mysqli -> query($sql)) {
	echo "OK\n";
}
else {
	echo "Create failed";
	die;
}

//load data from csv
$handle = fopen("starbucks.csv","r");
if ($handle===false) {
	die ("Failed to open");
}
$stmt = $mysqli->prepare("insert into numbers.starbucks (name,calories,fat,carb,fiber,protein,sodium) values (?,?,?,?,?,?,?)");
$stmt->bind_param("siiiiii",$name,$cal,$fat,$carb,$fiber,$protein,$sodium);
//iterate over all rows of csv
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	$name = $data[0];
	$cal=$data[1];
	$fat=$data[2];
	$carb=$data[3];
	$fiber=$data[4];
	$protein=$data[5];
	$sodium=$data[6];
	if ($stmt->execute()) {
		print "Row $name added\n";
	} else {
		die ("Error on row $name");

	}
}
$stmt->close();
fclose($handle);
$mysqli -> close();
?>
