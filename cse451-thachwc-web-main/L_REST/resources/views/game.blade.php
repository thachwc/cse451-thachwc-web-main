<!DOCTYPE html>
<!--wendy thach -> game play for cse4541-->
<html lang="en">
<head>
  <meta name="generator" content=
  "HTML Tidy for HTML5 for Linux version 5.6.0">
  <title>simpleGame</title>
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
  <script src='game.js'></script>
  <style>
  td{
  width: 50px;
  height: 50px;
  }
  </style>
</head>
<body>
  <div class="container">
    <div id="error">
      error message here
    </div>
    <div id='pick' class="row">
      <div class="col-sm-5">
        Pick a game<br>
        <ul id='gameList'></ul><br>
        <form id='create' name="create">
          Create a game<br>
          name: <input type='text' id='boardName'><br>
          <button id='submit'>Create</button>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6" id='play'>
        play a game
        <h1 id='title'></h1><br>
        <table class='table-bordered'>
          <tr>
            <td id='c0'></td>
            <td id='c1'></td>
            <td id='c2'></td>
          </tr>
          <tr>
            <td id='c3'></td>
            <td id='c4'></td>
            <td id='c5'></td>
          </tr>
          <tr>
            <td id='c6'></td>
            <td id='c7'></td>
            <td id='c8'></td>
          </tr>
        </table><br>
        <br>
        <br>
        <button onclick='getGames();'>Show List of Games</button>
      </div>
    </div>
  </div>
</body>
</html>
