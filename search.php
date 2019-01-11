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
    <title>Search</title>
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
      input[type=text], input[type=number] {
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
        width: 92%;
        font-size: 14pt;
        font-family: "Garamond";
        margin-left: 4%;
	margin-top: 2%;
	margin-bottom: 4%;
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
      h2 {
        color: rgb(255, 204, 0);
      }
      a {
        color: rgb(255, 204, 0);
      }
      h3 {
        color: rgb(253, 246, 227);
      }
      .clickClass {
        color: rgb(253, 246, 227);
      }
      .clickProf {
        color: rgb(253, 246, 227);
      }
      h4 {
        color: rgb(253, 246, 227);
      }
      iframe {
        width: 1000px;
	height: 500px;
	margin-left: 2%;
      }
      #left {
        padding: 1%;
        margin-left: 2%;
        margin-top: 2%;
        font-size: 14pt;
        position: center;
        width: 46%;
        margin-bottom: 2%;
        float: left;
	display: inline-block;
      }
      #right {
        padding: 1%;
        margin-left: 2%;
	margin-top: 2%;
        font-size: 14pt;
        position: center;
        width: 46%;
        display: inline-block;
	float: left;
      }
    </style>
  </head>
  <body>
    <div class="bg">
      <header>
        <h1><strong>Search</strong></h1>
        <ul class="nav nav-pills" id="options">
          <li role="presentation"><a href="index.php" id="home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbspHome</a></li>
	  <li role="presentation" class="active"><a href="search.php" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbspSearch</a></li>
	  <li role="presentation"><a href="classes.php" id="classes"><span class="glyphicon glyphicon-education" aria-hidden="true"></span>&nbspClasses</a></li>
	  <li role="presentation"><a href="featured.php" id="featured"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>&nbspFeatured</a></li>
	  <li role="presentation"><a href="settings.php" id="settings"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>&nbspSettings</a></li>
	  <li role="presentation"><a href="controller.php?request=killSession" id="logout"><span class="glyphicon glyphicon-off" aria-hidden="true"></span>&nbspSign Out</a></li>
        </ul>
      </header>
      <div id="container" class="container">
        <div id="left">
	  <form>
	    <h2>Search for a Class</h2>
	    <label for="semester"><strong>Semester</strong></label><br>
	    <select id="semester">
	      <option value="" selected="selected"></option>
	      <option value="Fall">Fall</option>
	      <option value="Spring">Spring</option>
	      <option value="Summer">Summer</option>
	      <option value="January">January</option>
	    </select>
	    <label for="year"><strong>Year</strong></label><br>
	    <input id="year" type="number" min="2000" max="2099"></input>
	    <label for="subject"><strong>Subject</strong></label><br>
	    <select id="subject">
	      <option value="CS" selected="selected">All Subjects</option>
	      <option value="AAS">African-American and African Studies</option>
	      <option value="ASL">American Sign Language</option>
	      <option value="AMST">American Studies</option>
	      <option value="Anthropology">Anthropology</option>
	      <option value="APMA">Applied Mathematics</option>
	      <option value="Archaeology">Archaeology</option>
	      <option value="SARC">Architecture</option>
	      <option value="Art">Art</option>
	      <option value="Astronomy">Astronomy</option>
	      <option value="BIS">Bachelor of Interdisciplinary Studies</option>
	      <option value="Biology">Biology</option>
	      <option value="BME">Biomedical Engineering</option>
	      <option value="DARD">Business (Darden School)</option>
	      <option value="CHE">Chemical Engineering</option>
	      <option value="Chemistry">Chemistry</option>
	      <option value="CivicCommunityEngagement">Civic and Community Engagement</option>
	      <option value="CEE">Civil and Environmental Engineering</option>
	      <option value="Classics">Classics</option>
	      <option value="CogSci">Cognitive Science</option>
	      <option value="COLA">College Advising Seminars</option>
	      <option value="COMM">Commerce (McIntire School)</option>
	      <option value="CompSci">Computer Science</option>
	      <option value="CreativeWriting">Creative Writing</option>
	      <option value="CrossDisciplinary">Cross Disciplinary</option>
	      <option value="ENGR">Cross-Disciplinary Courses (ENGR)</option>
	      <option value="EDIS">Curriculum, Instruction, and Special Education</option>
	      <option value="DataScience">Data Science</option>
	      <option value="Drama">Drama</option>
	      <option value="EALC">East Asian Languages, Literatures, and Cultures</option>
	      <option value="EAS">East Asian Studies</option>
	      <option value="Economics">Economics</option>
	      <option value="EDLF">Education Leadership, Foundations, and Policy</option>
	      <option value="ECE">Electrical and Computer Engineering</option>
	      <option value="ELA">Engaging the Liberal Arts</option>
	      <option value="SEAS">Engineering and Applied Sciences</option>
	      <option value="English">English</option>
	      <option value="EnviSci">Environmental Sciences</option>
	      <option value="ETP">Environmental Thought and Practice</option>
	      <option value="EuropeanStudies">European Studies</option>
	      <option value="French">French Languages and Literatures</option>
	      <option value="German">German Languages and Literatures</option>
	      <option value="GCIAIT">Global Citizenry in Action and in Translation</option>
	      <option value="GS">Global Studies</option>
	      <option value="GlobalSustainability">Global Sustainability</option>
	      <option value="History">History</option>
	      <option value="EDHS">Human Services</option>
	      <option value="IHGC">Institute of the Humanities and Global Culture</option>
	      <option value="INST">Interdisciplinary Studies</option>
	      <option value="JWST">Jewish Studies</option>
	      <option value="KINE">Kinesiology</option>
	      <option value="LAS">Latin American Studies</option>
	      <option value="LAW">Law School</option>
	      <option value="LEAD">Leadership and Public Policy</option>
	      <option value="LASE">Liberal Arts Seminars</option>
	      <option value="Linguistics">Linguistics</option>
	      <option value="MSE">Materials Science and Engineering</option>
	      <option value="Mathematics">Mathematics</option>
	      <option value="MAE">Mechanical and Aerospace Engineering</option>
	      <option value="MDST">Media Studies</option>
	      <option value="MED">Medical School</option>
	      <option value="MSP">Medieval Studies</option>
	      <option value="MESA">Middle Eastern and South Asian Languages and Cultures</option>
	      <option value="MESP">Middle Eastern Studies</option>
	      <option value="Music">Music</option>
	      <option value="Neuroscience">Neuroscience</option>
	      <option value="NURS">Nursing School</option>
	      <option value="PAVS">Pavillion Seminars</option>
	      <option value="Philosophy">Philosophy</option>
	      <option value="Physics">Physics</option>
	      <option value="PST">Political and Social Thought</option>
	      <option value="Politics">Politics</option>
	      <option value="Psychology">Psychology</option>
	      <option value="PHS">Public Health Sciences</option>
	      <option value="PPOL">Public Policy (Batten School)</option>
	      <option value="ReliStu">Religious Studies</option>
	      <option value="STS">Science, Technology, and Society</option>
	      <option value="Slavic">Slavic Languages and Literatures</option>
	      <option value="Sociology">Sociology</option>
	      <option value="SASP">South Asian Studies</option>
	      <option value="SPAN">Spanish, Italian, and Portuguese</option>
	      <option value="Statistics">Statistics</option>
	      <option value="SYS">Systems and Information Engineering</option>
	      <option value="USEM">University Seminars</option>
	      <option value="WGS">Women, Gender, and Sexuality</option>
            </select>
	    <button type="submit" id="searchClass"><strong>Search for Class</strong></button>
	  </form>
        </div>
        <div id="right" class="container">
          <form>
	    <h2>Search for a Professor</h2>
	    <label for="name"><strong>Name</strong></label><br>
	    <input id="name" type="text" maxlength="40"></input>
	    <button type="submit" id="searchProfessor"><strong>Search for Professor</strong></button>
	  </form>
        </div>
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
  <script src="search.js"></script>
  </body>
</html>