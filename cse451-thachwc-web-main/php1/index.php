<?php
session_start();

function getValue($name) {
	if(isset($_REQUEST[$name])) {
		return $_REQUEST[$name];
	}
	else {
		return "";
	}
}

function getSession($name) {
	if(isset($_SESSION[$name])) {
		return $_SESSION[$name];
	}
	else {
		return "";
	}
}

if(getValue("cmd") == "images") {
	if($_SESSION['imageIndex'] == 0) {
		$image = "<h2>Images</h2>
			<img src=\"IMG_9271.jpg\" width=\"400px\">
			<br>
			<p style=\"width: 400px\">River of Niagara Falls in Canada taken by my friend HT on September 27, 2022.</p>";
	}
	if($_SESSION['imageIndex'] == 1) {
		$image = "<h2>Images</h2>
			<img src=\"IMG_8366.jpg\" width=\"400px\">
			<br>
			<p style=\"width: 400px\">Set of 6 Macarons from Tous les Jours in Chicago taken by me.</p>";
	}
	if($_SESSION['imageIndex'] == 2) {
		$image = "<h2>Images</h2>
			<img src=\"IMG_0006.jpg\" width=\"400px\">
			<br>
			<p style=\"width: 400px\">Cake Display from Paris Baguette in Downtown Cincinnati taken by me.</p>";
	}
	$_SESSION['imageIndex']++;
	if(getSession('imageIndex') == 3) {
		$_SESSION['imageIndex'] = 0;
	}
}

if(getSession('value') == "") {
	$_SESSION['value'] = 0;
	$value = 0;
}

if(getValue("cmd") == "clear") {
	$_SESSION['value'] = 0;
	header("Location: " . $_SERVER['SCRIPT_URL']);
}

if(getValue("cmd") == "inc") {
	$_SESSION['value']++;
	header("Location: " . $_SERVER['SCRIPT_URL']);
}

if(getValue("cmd") == "dec") {
	$_SESSION['value']--;
	header("Location: " . $_SERVER['SCRIPT_URL']);
}
$value = getSession('value');

?>
<!DOCTYPE HTML>
<!--Wendy Thach, CSE451-->
<html lang=en>
	<head>
		<meta charset=utf-8>
		<title>PHP</title>
	<style>
	div {
		margin: auto;
		width: 600px;
	}
	</style>
	</head>
	<body>
		<div>
			Value = <?php echo $value;?>
			<br>
			<?php echo $image;?>
			<footer>
				<a href="index.php?cmd=clear">Clear</a>
				<a href="index.php?cmd=inc">Inc</a>
				<a href="index.php?cmd=dec">Dec</a>
				<a href="index.php?cmd=images">Images</a>
				<a href="index.php">Home</a>
			</footer>
		</div>
	</body>
</html>
