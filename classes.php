<?php
  session_start();
  // DRA
  if ($_SESSION['authenticated'] != true) {
    header('Location:login.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Classes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
      html, body {
        background-color: rgb(0, 43, 54);
        color: rgb(238, 232, 213);
        text-align: left;
      }
      header {
        font-family: "Garamond";
        text-align: center;
        background-color: rgb(0, 0, 153);
        color: rgb(255, 153, 0);
        padding: 1%;
        overflow: hidden;
        width: 100%;
      }
      footer {
        font-size: 12pt;
        text-align: center;
        background-color: rgb(0, 0, 153);
        color: rgb(255, 153, 0);
        padding: 1%;
        overflow: hidden;
        width: 100%;
        margin-bottom: 0%;
	position: fixed;
        bottom: 0%;
      }
      .bg {
        height: 100%;
      }
      input[type=text], input[type=number]{
        width: 98%;
        background-color: rgb(253, 246, 227);
        margin-bottom: 1%;
        color: rgb(0, 43, 54);
      }
      select, option {
        width: 98%;
        background-color: rgb(253, 246, 227);
        margin-bottom: 2%;
        color: rgb(0, 43, 54);
      }
      button {
        background-color: rgb(255, 204, 0);
        color: rgb(43, 54, 193);
        margin: 1% 0;
        width: 92%;
        font-size: 14pt;
        font-family: "Garamond";
        margin-left: 4%;
	padding-top: 0.5%;
	padding-bottom: 0.5%;
      }
      button:hover {
        opacity: 0.9;
      }
      #add {
        width: 30%;
	margin-left: 2%;
	float: left;
	display: inline-block;
	margin-bottom: 2%;
      }
      #edit {
        width: 30%;
	margin-left: 2%;
	display: inline-block;
	float: left;
	margin-bottom: 2%;
      }
      #remove {
        width: 30%;
	margin-left: 2%;
	display: inline-block;
	float: left;
	margin-bottoms: 2%;
      }
      button:hover {
        opacity: 0.9;
      }
      .container {
        padding: 1%;
        margin-left: 2%;
        margin-top: 2%;
        font-size: 14pt;
        position: center;
        width: 92%;
        margin-bottom: 2%;
        float: left;
	padding-bottom: 2%;
      }
      header h1 {
        font-size: 48pt;
      }
      header li {
        padding-left: 1%;
	font-size: 14pt;
      }
      table, th, td {
        margin: 2%;
	padding: 2%;
	text-align: left;
	font-size: 12pt;
	font-color: rgb(253, 246, 227);
      }
      a {
        color: rgb(255, 204, 0);
      }
    </style>
  </head>
  <body>
    <div class="bg">
      <header>
        <h1><strong>My Classes</strong></h1>
        <ul class="nav nav-pills" id="options">
          <li role="presentation"><a href="index.php" id="home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbspHome</a></li>
	  <li role="presentation"><a href="search.php" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbspSearch</a></li>
	  <li role="presentation" class="active"><a href="classes.php" id="classes"><span class="glyphicon glyphicon-education" aria-hidden="true"></span>&nbspClasses</a></li>
	  <li role="presentation"><a href="featured.php" id="featured"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>&nbspFeatured</a></li>
	  <li role="presentation"><a href="settings.php" id="settings"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>&nbspSettings</a></li>
	  <li role="presentation"><a href="controller.php?request=killSession" id="logout"><span class="glyphicon glyphicon-off" aria-hidden="true"></span>&nbspSign Out</a></li>
        </ul>
      </header>
      <div id="container" class="container">
        <div id="buttons">
          <button type="submit" id="add"><strong>Add</strong></button>
	  <button type="submit" id="edit"><strong>Edit</strong></button>
	  <button type="submit" id="remove"><strong>Remove</strong></button>
	</div>
        <table class="table">
          <thead>
	    <tr id="header-row">
	      <th scope="col">Semester</th>
	      <th scope="col">Year</th>
	      <th scope="col">Title</th>
	      <th scope="col">Credits</th>
	      <th scope="col">Grade</th>
	    </tr>
	  </thead>
	  <tbody id="tbody">
	  </tbody>
        </table>
      </div>
      <p>&nbsp</p>
      <p>&nbsp</p>
      <p>&nbsp</p>
      <p>&nbsp</p>
      <p>&nbsp</p>
    <footer>
      <p>Copyright &copy Denny Anderson</p>
    </footer>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="classes.js"></script>
  </body>
</html>