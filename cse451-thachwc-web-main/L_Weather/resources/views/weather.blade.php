<!DOCTYPE html>
<!-- Wendy Thach -> L_Weather assignment for cse451-->
<html lang="en">
<head>
<meta name="generator" content=
  "HTML Tidy for HTML5 for Linux version 5.6.0">
  <title>Weather Assignment</title>
  <meta charset="utf-8">
  <meta name="viewport" content=
  "width=device-width, initial-scale=1">
  <link rel="stylesheet" href=
  "https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

  <script src=
  "https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
  <script src=
  "https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src=
  "https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src='weather.js'> var u = {user};</script>
</head>
<body>
	<h1>Weather Assignment</h1>
	<div class="container">
		<b>Enter a valid zipcode</b><br>
		Zipcode: <input type='text' id='zipcode' name='zipcode'><br>
		<button onclick='getTemp();'>Enter</button>
	</div>
	<p id='error'></p>
	<div id ='weather'>
		<h5>Zipcode</h5>
		<p id='zip'></p>
		<h5>Result</h5>
		<p id='result'></p>
		<div class="row">
			<div class="col-sm-6">
				<h5>Today</h5>
				<ul id='todayList'></ul><br>
			</div>
			<div class="col-sm-6">
				<h5>Tomorrow</h5>
				<ul id='tmrList'></ul><br>
			</div>
		</div>
	</div>
</body>
</html>
