<?php
  session_start();
  // DRA
  require_once('login-model.php');
  if(isset($_POST['cmd']) && $_POST['cmd'] == 'login') {
    $id = $_POST['computing-id'];
    $password = $_POST['password'];
    $model = new Login();
    try {
      $login = $model->verify($id, $password);
      $_SESSION['authenticated'] = true;
      $_SESSION['computing-id'] = $id;
      $_SESSION['first-name'] = "";
      header('Location:login-success.php');
    }
    catch (Exception $e) {
      echo "<script>alert('Incorrect Computing ID or Password. Please try logging in again or creating a new account. {$e->getMessage()}'); window.location.href='login.php';</script>";
    }
  }
  else {
    header('Location:login.php');
  }
?>