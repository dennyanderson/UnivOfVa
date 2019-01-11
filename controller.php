<?php
  session_start();
  // DRA
  require_once('view.php');
  $view = new View();
  $request = $_GET['request'];
  if (!isset($_SESSION['authenticated']) && $request != 'getFirstName' && $request != 'createAccount') {
    header('Location:login.php');
  }
  else if ($request == 'getFirstName') {
    if ($_SESSION['authenticated']) {
      $id = $_SESSION['computing-id'];
      $view->getFirstName($id);
      header('Location:login-success.php');
    }
    else {
      header('Location:login.php');
    }
  }
  else if ($request == 'createAccount') {
    $id = $_POST['id'];
    $first = $_POST['first'];
    $last = $_POST['last'];
    $password = $_POST['password'];
    $career = $_POST['career'];
    $program = $_POST['program'];
    $area1 = $_POST['area1'];
    $area2 = $_POST['area2'];
    if (strlen($id) < 1 || strlen($id) > 10 || strlen($first) < 1 || strlen($first) > 20 || strlen($last) < 1 || strlen($last) > 20 || strlen($password) < 8 || strlen($password) > 128 || strlen($career) < 1 || strlen($career) > 13 || strlen($program) < 1 || strlen($program) > 30 || strlen($area1) < 1 || strlen($area1) > 53 || strlen($area2) < 1 || strlen($area2) > 53 || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/', $password) || preg_match('/[<>]/', $id) || preg_match('/[<>]/', $first) || preg_match('/[<>]/', $last) || preg_match('/[<>]/', $career) || preg_match('/[<>]/', $program) || preg_match('/[<>]/', $area1) || preg_match('/[<>]/', $area2)) {
      $information = "createAccount//" . $id . "//" . $first . "//" . $last . "//" . $password . "//" . $career . "//" . $program . "//" . $area1 . "//" . $area2;
      $view->jsInjection($id, $information);
    }
    else {
      $password = hash('sha512', $_POST['password']);
      $view->createAccount($id, $first, $last, $password, $career, $program, $area1, $area2);
    }
  }
  else if ($request == 'killSession') {
    session_unset();
    session_destroy();
    header('Location:index.php');
  }
  else if ($request == 'fetchData') {
    $id = $_SESSION['computing-id'];
    $view->fetchData($id);
  }
  else if ($request == 'editData') {
    $id = $_SESSION['computing-id'];
    $password = $_POST['password'];
    $career = $_POST['career'];
    $program = $_POST['program'];
    $area1 = $_POST['area1'];
    $area2 = $_POST['area2'];
    if ($password != "") {
      if (strlen($password) < 8 || strlen($password) > 128 || strlen($career) < 1 || strlen($career) > 13 || strlen($program) < 1 || strlen($program) > 30 || strlen($area1) < 1 || strlen($area1) > 53 || strlen($area2) < 1 || strlen($area2) > 53 || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/', $password) || preg_match('/[<>]/', $career) || preg_match('/[<>]/', $program) || preg_match('/[<>]/', $area1) || preg_match('/[<>]/', $area2)) {
        $information = "editData//" . $id . "//" . $password . "//" . $career . "//" . $program . "//" . $area1 . "//" . $area2;
        $view->jsInjection($id, $information);
      }
      else {
        $password = hash('sha512', $_POST['password']);
        $view->editData($id, $password, $career, $program, $area1, $area2);
      }
    }
    else {
      if (strlen($career) < 1 || strlen($career) > 13 || strlen($program) < 1 || strlen($program) > 30 || strlen($area1) < 1 || strlen($area1) > 53 || strlen($area2) < 1 || strlen($area2) > 53 || preg_match('/[<>]/', $career) || preg_match('/[<>]/', $program) || preg_match('/[<>]/', $area1) || preg_match('/[<>]/', $area2)) {
        $information = "editData//" . $id . "//" . $password . "//" . $career . "//" . $program . "//" . $area1 . "//" . $area2;
        $view->jsInjection($id, $information);
      }
      else {
        $view->editData($id, "", $career, $program, $area1, $area2);
      }
    }
  }
  else if ($request == 'fetchClasses') {
    $id = $_SESSION['computing-id'];
    $view->fetchClasses($id);
  }
  else if ($request == 'addClass') {
    $id = $_SESSION['computing-id'];
    $semester = $_POST['semester'];
    $year = $_POST['year'];
    $title = $_POST['title'];
    $credits = $_POST['credits'];
    $grade = $_POST['grade'];
    if (($semester != "Fall" && $semester != "Spring" && $semester != "Summer" && $semester != "January") || $year == "" || $year < 0 || $year > 32767 || strlen($title) < 1 || strlen($title) > 30 || $credits == "" || $credits < 0 || $credits > 255 || strlen($grade) > 2 || preg_match('/[<>]/', $year) || preg_match('/[<>]/', $title) || preg_match('/[<>]/', $credits) || preg_match('/[<>]/', $grade)) {
      $information = "addClass//" . $id . "//" . $semester . "//" . $year . "//" . $title . "//" . $credits . "//" . $grade;
      $view->jsInjection($id, $information);
    }
    else {
      $view->addClass($id, $semester, $year, $title, $credits, $grade);
    }
  }
  else if ($request == 'editClass') {
    $id = $_SESSION['computing-id'];
    $semester = $_POST['semester'];
    $year = $_POST['year'];
    $title = $_POST['title'];
    $newSemester = $_POST['newSemester'];
    $newYear = $_POST['newYear'];
    $newTitle = $_POST['newTitle'];
    $newCredits = $_POST['newCredits'];
    $newGrade = $_POST['newGrade'];
    if (($newSemester != "Fall" && $newSemester != "Spring" && $newSemester != "Summer" && $newSemester != "January") || $newYear == "" || $newYear < 0 || $newYear > 32767 || strlen($newTitle) < 1 || strlen($newTitle) > 30 || $newCredits == "" || $newCredits < 0 || $newCredits > 255 || strlen($newGrade) > 2 || preg_match('/[<>]/', $newYear) || preg_match('/[<>]/', $newTitle) || preg_match('/[<>]/', $newCredits) || preg_match('/[<>]/', $newGrade)) {
      $information = "editClass//" . $id . "//" . $newSemester . "//" . $newYear . "//" . $newTitle . "//" . $newCredits . "//" . $newGrade;
      $view->jsInjection($id, $information);
    }
    else {
      $view->editClass($id, $semester, $year, $title, $newSemester, $newYear, $newTitle, $newCredits, $newGrade);
    }
  }
  else if ($request == 'removeClass') {
    $id = $_SESSION['computing-id'];
    $semester = $_POST['semester'];
    $year = $_POST['year'];
    $title = $_POST['title'];
    $view->removeClass($id, $semester, $year, $title);
  }
  else if ($request == 'fetchClassInfo') {
    $department = $_POST['department'];
    $course = $_POST['course'];
    $number = $_POST['number'];
    $view->fetchClassInfo($department, $course, $number);
  }
  else if ($request == 'fetchProfessorInfo') {
    $professor = $_POST['professor'];
    $view->fetchProfessorInfo($professor);
  }
  else if ($request == 'fetchDiscussion') {
    $id = $_SESSION['computing-id'];
    $course = $_POST['course'];
    $number = $_POST['number'];
    $at = $_POST['at'];
    $hashtag = $_POST['hashtag'];
    $post = $_POST['post'];
    if (strlen($course) > 4 || strlen($number) > 4 || strlen($at) > 10 || strlen($hashtag) > 20 || strlen($post) > 160 || preg_match('/[<>]/', $course) || preg_match('/[<>]/', $number) || preg_match('/[<>]/', $at) || preg_match('/[<>]/', $hashtag) || preg_match('/[<>]/', $post)) {
      $information = "fetchDiscussion//" . $id . "//" . $course . "//" . $number . "//" . $at . "//" . $hashtag . "//" . $post;
      $view->jsInjection($id, $information);
    }
    else {
      $view->fetchDiscussion($course, $number, $at, $hashtag, $post);
    }
  }
  else if ($request == 'postComment') {
    $id = $_SESSION['computing-id'];
    $first = $_SESSION['first-name'];
    $course = $_POST['course'];
    $number = $_POST['number'];
    $at = $_POST['at'];
    $hashtag = $_POST['hashtag'];
    $post = $_POST['post'];
    if (strlen($course) > 4 || strlen($number) > 4 || strlen($at) > 10 || strlen($hashtag) > 20 || strlen($post) < 1 || strlen($post) > 160 || preg_match('/[<>]/', $course) || preg_match('/[<>]/', $number) || preg_match('/[<>]/', $at) || preg_match('/[<>]/', $hashtag) || preg_match('/[<>]/', $post)) {
      $information = "postComment//" . $id . "//" . $first . "//" . $course . "//" . $number . "//" . $at . "//" . $hashtag . "//" . $post;
      $view->jsInjection($id, $information);
    }
    else {
      $view->postComment($id, $first, $course, $number, $at, $hashtag, $post);
    }
  }
  else if ($request == 'fetchMajors') {
    $id = $_SESSION['computing-id'];
    $view->fetchMajors($id);
  }
  else if ($request == 'fetchClassSuggestions') {
    $id = $_SESSION['computing-id'];
    $major1 = $_POST['major1'];
    $major2 = $_POST['major2'];
    $view->fetchClassSuggestions($id, $major1, $major2);
  }
  else {
    header('Location:login.php');
  }
?>