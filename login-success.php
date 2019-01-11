<?php
  session_start();
  // DRA
  if ($_SESSION['authenticated']) {
    if (!$_SESSION['first-name']) {
      header('Location:controller.php?request=getFirstName');
    }
    header('Location:index.php');
  }
  else {
    header('Location:login.php');
  }
?>