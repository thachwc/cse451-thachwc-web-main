<?php
session_start();
/*
 * Wendy Thach
 * Cse451
 * Create db, table, and load anime data
 *
 * needs passwd.php
 */

require("./passwd.php");
$mysqli = new mysqli("localhost", $user, $pwd, $db);

if($mysqli -> connect_errno) {
	echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
	exit();
}

function getRequest($name) {
	if(isset($_REQUEST[$name])) {
		return $_REQUEST[$name];
	}
	else {
		return "";
	}
}
$user = getRequest("user");
if($user=="") {
	if(isset($_SESSION['use']))
		$user = $_SESSION['use'];
	else
		$user = "";
}
$_SESSION['use'] = $user;

$id = getRequest("id");
if($id=="") {
	if(isset($_SESSION['i']))
		$id = $_SESSION['i'];
	else
		$id = 0;
}

if(getRequest("logout") == "true"){
	$user = "";
	$_SESSION['use'] = $user;
	header('Location: index.php');
	exit;
}

if(getRequest("cmd") == "first")
	$id = 0;
if(getRequest("cmd") == "next")
	$id += 25;
if(getRequest("cmd") == "prev")
	$id -= 25;
$_SESSION['i'] = $id;

function getRecords($id){
	global $mysqli;
	try {
		$sql = "SELECT title,episodes,studios,genres FROM anime WHERE pk>? LIMIT 25;";
		$stmt = $mysqli->prepare($sql);
	} catch (Exception $e) {
		die("Invalid prepare");
	}
	$stmt->bind_param("i",$id);
	if(!$stmt->execute()) {
		die("Error on execute");
	}
	if(!$stmt->bind_result($title, $epi, $stu, $gen)) {
		die("Error on bind result");
	}
	while ($stmt->fetch()) {
		print "<tr><td>$title</td><td>$epi</td><td>$stu</td><td>$gen</td></tr>";
	}
	$stmt->close();
}

?>
<!DOCTYPE HTML>
<html lang=en>
<head>
	<meta charset="utf-8">
	<title>Anime</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<h1 class="text-center">Anime Guide</h1>
	<?php
	if($user==""):
	?>
		<p class="text-center">Please provide your name</p>
		<form method="post" class="text-center">
			<input type="text" name="user" value="<?php print $user;?>">
			<input type="submit">
		</form>
	<?php
	else:
	?>
		<h2 class="text-center">Welcome <?php echo $user;?></h2>
		<div class="row">
			<div class="col-lg-12">
				<div>
					<a href="index.php?logout=true"><button>Logout</button></a>
					<a href="index.php?cmd=first"><button>first</button></a>
					<?php
					if($id != 0):?>
						<a href="index.php?cmd=prev"><button>prev</button></a>
					<?php
					endif;?>
					<a href="index.php?cmd=next"><button>next</button></a>
					Showing records starting at <?php echo $id;?>
				</div>
				<table class='table'>
				<thead>
					<th>Title</th><th>Episodes</th><th>Studios</th><th>Genres</th>
				</thead>
				<tbody>
					<?php getRecords($id);?>
				</tbody>
				</table>
			</div>
		</div>
	<?php
	endif;
	?>
	</div>
</body>
</html>
