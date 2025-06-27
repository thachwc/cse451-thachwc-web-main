<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<title>L_DB</title>

    </head>
    <body>
	<div class="container text-center">
		<h1 class="text-center">L_DB</h1>
		<h3 class="text-center">Welcome {{$user}}</h3>
		<div class="row">
			<div class="col-lg-12">
				<table class='table'>
					<thead>
						<th>ID</th><th>Time Of Capture</th><th>Type</th><th>Source IP</th><th>Source Port</th><th>Destination IP</th><th>Destination Port</th><th>Content Of Capture</th><th>Comments</th>
					</thead>
					<tbody>
						@foreach($data as $item)
							<tr>
							<td>{{$item['id']}}</td>
							<td>{{$item['timeOfCapture']}}</td>
							<td>{{$item['type']}}</td>
                                                        <td>{{$item['sourceIP']}}</td>
                                                        <td>{{$item['sourcePort']}}</td>
                                                        <td>{{$item['destIP']}}</td>
                                                        <td>{{$item['destPort']}}</td>
                                                        <td>{{$item['contentOfCapture']}}</td>
							<td>{{$item['comments']}}</td>
							<td><a href="edit?id={{$item['id']}}">Edit</a><td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
    </body>
</html>

