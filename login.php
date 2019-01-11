<!DOCTYPE html>
<!-- DRA -->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Univ of VA</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <style>
      html, body {
        height: 100%;
      }
      header {
        font-family: "Garamond";
        text-align: center;
        background-color: rgb(0,0,153);
        color: rgb(255,153,0);
        padding: 1%;
        overflow: hidden;
        width: 100%;
        opacity: 0.8;
      }
      footer {
        font-size: 12pt;
        text-align: center;
        background-color: rgb(0,0,153);
        color: rgb(255,153,0);
        padding: 1%;
        overflow: hidden;
        width: 100%;
        margin-bottom: 0%;
        bottom: 0%;
        position: fixed;
        opacity: 0.8;
      }
      .bg {
        background-image: url("login-background.jpg");
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }
      input[type=text], input[type=password] {
        width: 100%;
        padding: 1% 1%;
        margin-bottom: 1%;
        opacity: 0.8;
        font-size: 14pt;
        position: center;
      }
      button {
        background-color: rgb(255, 204, 0);
        color: rgb(43, 54, 193);
        padding: 1% 1%;
        margin: 2% 0;
        width: 100%;
        opacity: 0.8;
        font-size: 14pt;
      }
      button:hover {
        opacity: 0.9;
      }
      .container {
        padding: 1%;
        margin-left: 2%;
        opacity: 0.8;
        margin-top: 2%;
        font-size: 14pt;
        position: center;
        background: white;
        width: 30%;
      }
      header h1 {
        font-size: 48pt;
      }
    </style>
  </head>
  <body>
    <div class="bg">
      <header>
        <h1><strong>Welcome to Univ of VA!</strong></h1>
      </header>
      <form action="login-firewall.php" method="POST">
        <div class="container">
          <label for="computing-id"><strong>Computing ID</strong></label><br>
          <input id="computing-id" name="computing-id" type="text" required maxlength="10"></input><br>
          <label for="password"><strong>Password</strong></label><br>
          <input id="password" name="password" type="password" required maxlength="128"></input><br>
          <button type="submit" name="cmd" value="login"><strong>Login</strong></button>
      </form>
      <form action="create-account.php" method="POST">
        <button id="new" type="submit" name="cmd" value="new">Create an Account</button>
        </div>
      </form>
      <footer>
        <p>Copyright &copy Denny Anderson</p>
      </footer>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>
  </body>
</html>
