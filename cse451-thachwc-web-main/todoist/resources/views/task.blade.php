<!DOCTYPE html>
<!-- Wendy Thach -> Todoist assignment for cse451-->
<html lang="en">
<head>
<meta name="generator" content=
  "HTML Tidy for HTML5 for Linux version 5.6.0">
  <title>todoist</title>
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
	<div class="row">
	<div class="col-md-8 offset-md-2">
		<h2>Todoist tasks</h2>
		<ul>
			@foreach($body as $item)
			<li>{{$item->content}}</li>
			@endforeach
		</ul>
	</div>
	<a href='https://thachwc.451.csi.miamioh.edu/cse451-thachwc-web/todoist/public/'>Project List</a>
	</div>
	</div>
</body>
</html>
