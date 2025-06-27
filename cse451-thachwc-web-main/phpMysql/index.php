<?php
session_start();
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

require("./passwd.php");
$mysqli = new mysqli("localhost",$user,$pwd,$db);

// Check connection
if ($mysqli -> connect_errno) {
	echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
	exit();
}

function getRequest($name) {
	if (isset($_REQUEST[$name]))
		return $_REQUEST[$name];
	else
		return "";
}

$likepk = getRequest("like");
if ($likepk != "") {
	//update like for this pk
	$sql = "update starbucks set likes=1 where pk=?";
	if(!$stmt = $mysqli->prepare($sql)) {
		die ("Error in prepare for like");
	}
	if (!$stmt->bind_param("i",$likepk)) 
		die ("Error in like bind_param");
	if (!$stmt->execute()) 
		die ("Error on like execute");

	$stmt->close();
	header("Location: index.php");
	exit;
}

//update min/max and sessions
$likeOnly = "<a href=\"index.php?cmd=likes\">Likes Only</a>";
$mincal = getRequest("mincal");
$maxcal = getRequest("maxcal");
$maxfat = getRequest("maxfat");

if ($mincal=="")
{
	//not in input, use sessoins
	if (isset($_SESSION['min']))
		$mincal = $_SESSION['min'];
	else 
		$mincal = 0;
}
if ($maxcal=="")
{
	//not in input, use sessions
	if (isset($_SESSION['max']))
		$maxcal = $_SESSION['max'];
	else 
		$maxcal = 1000;
}
if ($maxfat=="")
{
	if (isset($_SESSION['maxf']))
		$maxfat = $_SESSION['maxf'];
	else
		$maxfat = 1000;
}
if (getRequest("cmd") == "likes") {
	$likeOnly = "<a href=\"index.php?\">All</a>";
}
else {
	$likeOnly = "<a href=\"index.php?cmd=likes\">Likes Only</a>";
}
$_SESSION['min'] = $mincal;
$_SESSION['max'] = $maxcal;
$_SESSION['maxf'] = $maxfat;



function getRecords($minCal,$maxCal,$maxFat) {
	global $mysqli;
	//$sql = "select pk,name,calories,fat,carb,fiber,protein,sodium,likes from starbucks where calories>=? and calories<=? and fat<=?";
	if (getRequest("cmd") == "likes") {
		$sql = "select pk,name,calories,fat,carb,fiber,protein,sodium,likes from starbucks where calories>=? and calories<=? and fat<=? and likes>0";
	}
	else {
		$sql = "select pk,name,calories,fat,carb,fiber,protein,sodium,likes from starbucks where calories>=? and calories<=? and fat<=?";
	}

	if (!$stmt = $mysqli->prepare($sql))
		die("Invalid prepare");
	$stmt->bind_param("iii",$minCal,$maxCal,$maxFat);
	if (!$stmt->execute()) {
		die("Error on execute");
	}
	if (!$stmt->bind_result($pk,$name,$cal,$fat,$carb,$fiber,$protein,$sodium,$likes)) {
		die("Error on bind result");
	}

	while ($stmt->fetch()) {
		print "<tr><td>$name</td><td>$cal</td><td>$fat</td><td>";
		if ($likes>0) {
			print '&#9733;';
		} else 
			print '<a href="index.php?like=' . $pk . '">&#9734;</a>';
		print "</td></tr>";
	}
	$stmt->close();
}


?>
<!doctype html>
<html lang=en>
<head>
    <meta charset="utf-8"> 
<title>starbucks</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

</head>
<body>
<div class="container">
<h1 class="text-center">Starbuck Nutrition Guide</h1>
<div class="row">
<div class="col-lg-4">
	<form method="post">
	   <div class="form-group">
	       <label for="mincal">Minimum Calories</label>
	       <input type="text" class="form-control" placeholder="number" id="mincal" name="mincal" value="<?php print $mincal;?>">

	    </div>
	   <div class="form-group">
	    <label for="maxcal">Maximum Calories</label>
	    <input type="text" class="form-control" placeholder="number" id="maxcal" name="maxcal" value="<?php print $maxcal;?>">
	  </div>
	  <div class="form-group">
            <label for="maxfat">Maximum Fat</label>
            <input type="text" class="form-control" placeholder="number" id="maxfat" name="maxfat" value="<?php print $maxfat;?>">
          </div>
	<div class="form-group">
	<input type='submit'>
	</div>
	</form>
	<button>
		<?php echo $likeOnly;?>
	</button>

</div>
<div class="col-lg-8">
<table class='table'>
<thead>
<th>Name</th><th>calories</th><th>Fat</th><th>Like</th>
</thead>
<tbody>
<?php getRecords($mincal,$maxcal,$maxfat);
?>
</tbody>
</table>
</div>
</div>
</body>
<html>



