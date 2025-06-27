<?php
date_default_timezone_set('America/New_York');
$date = date('g:i a');
?>
<!DOCTYPE html>
<!--wendy thach -> exam2 for cse451-->
<html lang="en">
<head>
  <meta name="generator" content=
  "HTML Tidy for HTML5 for Linux version 5.6.0">
  <title>Exam2</title>
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
</head>
<body>
<div class="container">
<h1>{{$date}}</h1>
</div>
</body>
</html>
