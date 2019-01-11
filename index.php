<?php
  session_start();
  // DRA
  if ($_SESSION['authenticated'] != true) {
    header('Location:login.php');
  }
  if (!$_SESSION['first-name']) {
    header('Location:controller.php?request=getFirstName');
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
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
      p {
        font-color: rgb(253, 246, 227);
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
      select, option {
        width: 98%;
        background-color: rgb(253, 246, 227);
        margin-bottom: 2%;
        color: rgb(0, 43, 54);
      }
      button {
        background-color: rgb(255, 204, 0);
        color: rgb(43, 54, 193);
        padding: 1% 1%;
        margin: 1% 0;
        width: 92%;
        font-size: 14pt;
        font-family: "Garamond";
        margin-left: 4%;
      }
      button:hover {
        opacity: 0.9;
      }
      #infoContainer {
        padding: 1%;
	margin-left: 2%;
	margin-top: 2%;
	font-size: 14pt;
	position: center;
	width: 92%;
	margin-bottom: 2%;
      }
      #postContainer {
        padding: 1%;
	margin-left: 2%;
	margin-top: 2%;
	font-size: 14pt;
	position: center;
	width: 92%;
	margin-bottom: 2%;
      }
      .postContainerLeft {
	font-size: 12pt;
	width: 20%;
	height: 100%;
	display: inline-block;
	text-align: right;
      }
      .postContainerMiddle {
	font-size: 12pt;
	width: 15%;
	height: 100%;
	display: inline-block;
      }
      .postContainerRight {
	font-size: 14pt;
	width: 60%;
	height: 100%;
	display: inline-block;
      }
      .optional {
        width: 100%;
        background-color: rgb(253, 246, 227);
        color: rgb(0, 43, 54);
	font-size: 12pt;
	padding-left: 1%;
	padding-right: 1%;
      }
      #postPost {
        background-color: rgb(255, 204, 0);
	color: rgb(43, 54, 193);
	width: 40%;
	font-size: 12pt;
	font-family: "Garamond";
	padding-top: 0.5%;
	padding-bottom: 0.5%;
      }
      #postPost:hover {
        opacity: 0.9;
      }
      #searchPosts {
        background-color: rgb(255, 204, 0);
	color: rgb(43, 54, 193);
	width: 40%;
	font-size: 12pt;
	font-family: "Garamond";
	padding-top: 0.5%;
	padding-bottom: 0.5%;
      }
      #searchPosts:hover {
        opacity: 0.9;
      }
      .required {
        width: 100%;
        background-color: rgb(253, 246, 227);
        color: rgb(0, 43, 54);
	padding-left: 1%;
	padding-right: 1%;
	margin-left: 4%;
      }
      #discussionContainer {
        padding: 1%;
	margin-left: 2%;
	margin-top: 2%;
	font-size: 14pt;
	position: center;
	width: 92%;
	margin-bottom: 2%;
      }
      header h1 {
        font-size: 48pt;
      }
      header li {
        padding-left: 1%;
	font-size: 14pt;
      }
      a {
        color: rgb(255, 204, 0);
      }
      h1 {
        color: rgb(255, 153, 0);
	font-size: 48pt;
      }
      label {
        font-size: 12pt;
	text-align: right;
      }
      .timestamp {
        font-size: 10pt;
	color: rgb(147, 161, 161);
      }
    </style>
  </head>
  <body>
    <div class="bg">
      <header>
        <?php
          echo "<h1><strong>Welcome, " . $_SESSION['first-name'] . "!</strong></h1>";
        ?>
        <ul class="nav nav-pills" id="options">
          <li role="presentation" class="active"><a href="index.php" id="home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbspHome</a></li>
	  <li role="presentation"><a href="search.php" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbspSearch</a></li>
	  <li role="presentation"><a href="classes.php" id="classes"><span class="glyphicon glyphicon-education" aria-hidden="true"></span>&nbspClasses</a></li>
	  <li role="presentation"><a href="featured.php" id="featured"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>&nbspFeatured</a></li>
	  <li role="presentation"><a href="settings.php" id="settings"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>&nbspSettings</a></li>
	  <li role="presentation"><a href="controller.php?request=killSession" id="logout"><span class="glyphicon glyphicon-off" aria-hidden="true"></span>&nbspSign Out</a></li>
        </ul>
      </header>
      <div id="infoContainer">
        <h1>Discussion Board</h1>
      </div>
      <div id="postContainer">
        <div class="postContainerLeft">
	  <label for="course">Course</label>
	  <br>
	  <label for="number">Number</label>
	  <br>
	  <label for="at">@</label>
	  <br>
	  <label for="hashtag">#&nbsp</label>
	  <br>
	</div>
	<div class="postContainerMiddle">
	  <input class="optional" id="course" type="text" maxlength="4" placeholder="AAS"></input>
	  <br>
	  <input class="optional" id="number" type="text" maxlength="4" placeholder="1010"></input>
	  <br>
	  <input class="optional" id="at" type="text" maxlength="10" placeholder="mst3k"></input>
	  <br>
	  <input class="optional" id="hashtag" type="text" maxlength="20" placeholder="topic"></input>
	</div>
	<div class="postContainerRight">
	  <label for="post"></label>
	  <textarea id="post" class="required" maxlength="160" placeholder="comment"></textarea>
	  <br>
	  <button type="submit" id="searchPosts"><strong>SEARCH</strong></button>
	  <button type="submit" id="postPost"><strong>POST</strong></button>
	</div>
      </div>
      <div id="discussionContainer">
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
  <script src="index.js"></script>
  </body>
</html>