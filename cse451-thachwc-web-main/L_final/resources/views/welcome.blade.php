<!DOCTYPE html>
<!-- Wendy Thach -> Final Project for cse451-->
<html lang="en">
<head>
	<meta name="generator" content="HTML Tidy for HTML5 for Linux version 5.6.0">
	<title>Final project</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="weather.js"></script>
	<style>
		footer {
			background-color: #555;
			color: white;
			padding: 15px;
		}
		.box {
                        width: 200px;
                        margin: auto;
                }
	</style>
</head>
<body>
	<div class="container">	
		<h1>Final Project</h1>
		<h3 class="text-center">UniqueID: {{$uniqueID}} </h3>
		<div class="container box">
		<h5>List of Routes</h5>
		<ul>
			<li><a href="profile">Profile</a></li>
			<li><a href="numbers">Numbers</a></li>
			<li><a href="authors">Authors</a></li>
			<li><a href="auth">Auth</a></li>
			<li><a href="api">Api</a></li>
		</ul>
		</div>
		<footer class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<p>UniqueID: {{$uniqueID}}</p>
					<div id="weather"></div>
				</div>
			</div>
		</footer>
	</div>
</body>
</html>
