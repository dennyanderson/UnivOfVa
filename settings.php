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
    <title>Settings</title>
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
      input[type=text], input[type=password]{
        width: 98%;
        background-color: rgb(253, 246, 227);
        margin-bottom: 1%;
        color: rgb(0, 43, 54);
      }
      #computing-id, #first, #last {
        background-color: rgb(147, 161, 161);
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
    </style>
  </head>
  <body>
    <div class="bg">
      <header>
        <h1><strong>Change Settings</strong></h1>
        <ul class="nav nav-pills" id="options">
          <li role="presentation"><a href="index.php" id="home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbspHome</a></li>
	  <li role="presentation"><a href="search.php" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbspSearch</a></li>
	  <li role="presentation"><a href="classes.php" id="classes"><span class="glyphicon glyphicon-education" aria-hidden="true"></span>&nbspClasses</a></li>
	  <li role="presentation"><a href="featured.php" id="featured"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>&nbspFeatured</a></li>
	  <li role="presentation" class="active"><a href="settings.php" id="settings"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>&nbspSettings</a></li>
	  <li role="presentation"><a href="controller.php?request=killSession" id="logout"><span class="glyphicon glyphicon-off" aria-hidden="true"></span>&nbspSign Out</a></li>
        </ul>
      </header>
      <form>
	<div class="container" id="left">
	  <label for="computing-id"><strong>Computing ID</strong></label><br>
	  <input id="computing-id" name="computing-id" type="text" maxlength="10" readonly/><br>
	  <label for="first"><strong>First Name</strong></label><br>
	  <input id="first" name="first" type="text" maxlength="20" readonly/><br>
	  <label for="last"><strong>Last Name</strong></label><br>
	  <input id="last" name="last" type="text" maxlength="20" readonly/><br>
	  <label for="password"><strong>Password</strong></label><br>
	  <input id="password" name="password" type="password" maxlength="128" placeholder="leave blank to keep same password"/><br>
	</div>
	<div class="container" id="right">
	  <label for="career"><strong>Career</strong></label><br>
	  <select id="career" name="career"><br>
	    <option value="Undecided" selected="selected">Undecided</option>
	    <option value="Graduate">Graduate</option>
	    <option value="Law">Law</option>
	    <option value="Undergraduate">Undergraduate</option>
	  </select>
	  <label for="program"><strong>Academic Program</strong></label><br>
	  <select id="program" name="program"><br>
	    <option id="pu" value="Undecided" selected="selected">Undecided</option>
	  </select><br>
	  <label for="area1"><strong>Area of Study (Major/Minor 1)</strong></label><br>
	  <select id="area1" name="area1">
	    <option value="Undecided" selected="selected">Undecided</option>
	    <option value="African-American and African Studies">African-American and African Studies</option>
	    <option value="American Sign Language">American Sign Language</option>
	    <option value="American Studies">American Studies</option>
	    <option value="Anthropology">Anthropology</option>
	    <option value="Applied Mathematics">Applied Mathematics</option>
	    <option value="Archaeology">Archaeology</option>
	    <option value="Architecture">Architecture</option>
	    <option value="Art">Art</option>
	    <option value="Astronomy">Astronomy</option>
	    <option value="Bachelor of Interdisciplinary Studies">Bachelor of Interdisciplinary Studies</option>
	    <option value="Biology">Biology</option>
	    <option value="Biomedical Engineering">Biomedical Engineering</option>
	    <option value="Business (Darden School)">Business (Darden School)</option>
	    <option value="Chemical Engineering">Chemical Engineering</option>
	    <option value="Chemistry">Chemistry</option>
	    <option value="Civic and Community Engagement">Civic and Community Engagement</option>
	    <option value="Civil and Environmental Engineering">Civil and Environmental Engineering</option>
	    <option value="Classics">Classics</option>
	    <option value="Cognitive Science">Cognitive Science</option>
	    <option value="Commerce (McIntire School)">Commerce (McIntire School)</option>
	    <option value="Computer Science">Computer Science</option>
	    <option value="Creative Writing">Creative Writing</option>
	    <option value="Curriculum, Instruction, and Special Education">Curriculum, Instruction, and Special Education</option>
	    <option value="Data Science">Data Science</option>
	    <option value="Drama">Drama</option>
	    <option value="East Asian Languages, Literatures, and Cultures">East Asian Languages, Literatures, and Cultures</option>
	    <option value="East Asian Studies">East Asian Studies</option>
	    <option value="Economics">Economics</option>
	    <option value="Education Leadership, Foundations, and Policy">Education Leadership, Foundations, and Policy</option>
	    <option value="Electrical and Computer Engineering">Electrical and Computer Engineering</option>
	    <option value="Engaging the Liberal Arts">Engaging the Liberal Arts</option>
	    <option value="English">English</option>
	    <option value="Environmental Sciences">Environmental Sciences</option>
	    <option value="Environmental Thought and Practice">Environmental Thought and Practice</option>
	    <option value="European Studies">European Studies</option>
	    <option value="French Languages and Literatures">French Languages and Literatures</option>
	    <option value="German Languages and Literatures">German Languages and Literatures</option>
	    <option value="Global Citizenry in Action and in Translation">Global Citizenry in Action and in Translation</option>
	    <option value="Global Studies">Global Studies</option>
	    <option value="Global Sustainability">Global Sustainability</option>
	    <option value="History">History</option>
	    <option value="Human Services">Human Services</option>
	    <option value="Institute of the Humanities and Global Culture">Institute of the Humanities and Global Culture</option>
	    <option value="Jewish Studies">Jewish Studies</option>
	    <option value="Kinesiology">Kinesiology</option>
	    <option value="Latin American Studies">Latin American Studies</option>
	    <option value="Law School">Law School</option>
	    <option value="Leadership and Public Policy">Leadership and Public Policy</option>
	    <option value="Linguistics">Linguistics</option>
	    <option value="Materials Science and Engineering">Materials Science and Engineering</option>
	    <option value="Mathematics">Mathematics</option>
	    <option value="Mechanical and Aerospace Engineering">Mechanical and Aerospace Engineering</option>
	    <option value="Media Studies">Media Studies</option>
	    <option value="Medical School">Medical School</option>
	    <option value="Medieval Studies">Medieval Studies</option>
	    <option value="Middle Eastern and South Asian Languages and Cultures">Middle Eastern and South Asian Languages and Cultures</option>
	    <option value="Middle Eastern Studies">Middle Eastern Studies</option>
	    <option value="Music">Music</option>
	    <option value="Neuroscience">Neuroscience</option>
	    <option value="Nursing School">Nursing School</option>
	    <option value="Philosophy">Philosophy</option>
	    <option value="Physics">Physics</option>
	    <option value="Political and Social Thought">Political and Social Thought</option>
	    <option value="Politics">Politics</option>
	    <option value="Public Health Sciences">Public Health Sciences</option>
	    <option value="Public Policy (Batten School)">Public Policy (Batten School)</option>
	    <option value="Psychology">Psychology</option>
	    <option value="Religious Studies">Religious Studies</option>
	    <option value="Science, Technology, and Society">Science, Technology, and Society</option>
	    <option value="Slavic Languages and Literatures">Slavic Languages and Literatures</option>
	    <option value="Sociology">Sociology</option>
	    <option value="South Asian Studies">South Asian Studies</option>
	    <option value="Spanish, Italian, and Portuguese">Spanish, Italian, and Portuguese</option>
	    <option value="Statistics">Statistics</option>
	    <option value="Systems and Information Engineering">Systems and Information Engineering</option>
	    <option value="Women, Gender, and Sexuality">Women, Gender, and Sexuality</option>
          </select>
	  <label for="area2"><strong>Area of Study (Major/Minor 2)</strong></label><br>
	  <select id="area2" name="area2">
	    <option value="Undecided" selected="selected">Undecided</option>
	    <option value="African-American and African Studies">African-American and African Studies</option>
	    <option value="American Sign Language">American Sign Language</option>
	    <option value="American Studies">American Studies</option>
	    <option value="Anthropology">Anthropology</option>
	    <option value="Applied Mathematics">Applied Mathematics</option>
	    <option value="Archaeology">Archaeology</option>
	    <option value="Architecture">Architecture</option>
	    <option value="Art">Art</option>
	    <option value="Astronomy">Astronomy</option>
	    <option value="Bachelor of Interdisciplinary Studies">Bachelor of Interdisciplinary Studies</option>
	    <option value="Biology">Biology</option>
	    <option value="Biomedical Engineering">Biomedical Engineering</option>
	    <option value="Business (Darden School)">Business (Darden School)</option>
	    <option value="Chemical Engineering">Chemical Engineering</option>
	    <option value="Chemistry">Chemistry</option>
	    <option value="Civic and Community Engagement">Civic and Community Engagement</option>
	    <option value="Civil and Environmental Engineering">Civil and Environmental Engineering</option>
	    <option value="Classics">Classics</option>
	    <option value="Cognitive Science">Cognitive Science</option>
	    <option value="Commerce (McIntire School)">Commerce (McIntire School)</option>
	    <option value="Computer Science">Computer Science</option>
	    <option value="Creative Writing">Creative Writing</option>
	    <option value="Curriculum, Instruction, and Special Education">Curriculum, Instruction, and Special Education</option>
	    <option value="Data Science">Data Science</option>
	    <option value="Drama">Drama</option>
	    <option value="East Asian Languages, Literatures, and Cultures">East Asian Languages, Literatures, and Cultures</option>
	    <option value="East Asian Studies">East Asian Studies</option>
	    <option value="Economics">Economics</option>
	    <option value="Education Leadership, Foundations, and Policy">Education Leadership, Foundations, and Policy</option>
	    <option value="Electrical and Computer Engineering">Electrical and Computer Engineering</option>
	    <option value="Engaging the Liberal Arts">Engaging the Liberal Arts</option>
	    <option value="English">English</option>
	    <option value="Environmental Sciences">Environmental Sciences</option>
	    <option value="Environmental Thought and Practice">Environmental Thought and Practice</option>
	    <option value="European Studies">European Studies</option>
	    <option value="French Languages and Literatures">French Languages and Literatures</option>
	    <option value="German Languages and Literatures">German Languages and Literatures</option>
	    <option value="Global Citizenry in Action and in Translation">Global Citizenry in Action and in Translation</option>
	    <option value="Global Studies">Global Studies</option>
	    <option value="Global Sustainability">Global Sustainability</option>
	    <option value="History">History</option>
	    <option value="Human Services">Human Services</option>
	    <option value="Institute of the Humanities and Global Culture">Institute of the Humanities and Global Culture</option>
	    <option value="Jewish Studies">Jewish Studies</option>
	    <option value="Kinesiology">Kinesiology</option>
	    <option value="Latin American Studies">Latin American Studies</option>
	    <option value="Law School">Law School</option>
	    <option value="Leadership and Public Policy">Leadership and Public Policy</option>
	    <option value="Linguistics">Linguistics</option>
	    <option value="Materials Science and Engineering">Materials Science and Engineering</option>
	    <option value="Mathematics">Mathematics</option>
	    <option value="Mechanical and Aerospace Engineering">Mechanical and Aerospace Engineering</option>
	    <option value="Media Studies">Media Studies</option>
	    <option value="Medical School">Medical School</option>
	    <option value="Medieval Studies">Medieval Studies</option>
	    <option value="Middle Eastern and South Asian Languages and Cultures">Middle Eastern and South Asian Languages and Cultures</option>
	    <option value="Middle Eastern Studies">Middle Eastern Studies</option>
	    <option value="Music">Music</option>
	    <option value="Neuroscience">Neuroscience</option>
	    <option value="Nursing School">Nursing School</option>
	    <option value="Philosophy">Philosophy</option>
	    <option value="Physics">Physics</option>
	    <option value="Political and Social Thought">Political and Social Thought</option>
	    <option value="Politics">Politics</option>
	    <option value="Public Health Sciences">Public Health Sciences</option>
	    <option value="Public Policy (Batten School)">Public Policy (Batten School)</option>
	    <option value="Psychology">Psychology</option>
	    <option value="Religious Studies">Religious Studies</option>
	    <option value="Science, Technology, and Society">Science, Technology, and Society</option>
	    <option value="Slavic Languages and Literatures">Slavic Languages and Literatures</option>
	    <option value="Sociology">Sociology</option>
	    <option value="South Asian Studies">South Asian Studies</option>
	    <option value="Spanish, Italian, and Portuguese">Spanish, Italian, and Portuguese</option>
	    <option value="Statistics">Statistics</option>
	    <option value="Systems and Information Engineering">Systems and Information Engineering</option>
	    <option value="Women, Gender, and Sexuality">Women, Gender, and Sexuality</option>
          </select>
	</div>
	<button type="submit" id="click" name="cmd" value="create"><strong>Save Data</strong></button>
      </form>
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
  <script src="settings.js"></script>
  </body>
</html>