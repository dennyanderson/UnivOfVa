<?php
  // DRA
  require_once('model.php');
  class View {
    private $model;
    function __construct() {
      $this->model = new Model();
    }
    public function getFirstName($id) {
      $result = $this->model->getFirstName($id);
      $_SESSION['first-name'] = $result;
    }
    public function createAccount($id, $first, $last, $password, $career, $program, $area1, $area2) {
      $result = $this->model->createAccount($id, $first, $last, $password, $career, $program, $area1, $area2);
      if ($result == "pass") {
        $_SESSION['authenticated'] = true;
        $_SESSION['computing-id'] = $id;
        $_SESSION['first-name'] = $first;
      }
      echo $result;
    }
    public function fetchData($id) {
      $result = $this->model->fetchData($id);
      echo json_encode($result);
    }
    public function editData($id, $password, $career, $program, $area1, $area2) {
      $result = $this->model->editData($id, $password, $career, $program, $area1, $area2);
    }
    public function fetchClasses($id) {
      $result = $this->model->fetchClasses($id);
      echo json_encode($result);
    }
    public function addClass($id, $semester, $year, $title, $credits, $grade) {
      $result = $this->model->addClass($id, $semester, $year, $title, $credits, $grade);
      echo $result;
    }
    public function editClass($id, $semester, $year, $title, $newSemester, $newYear, $newTitle, $newCredits, $newGrade) {
      $result = $this->model->editClass($id, $semester, $year, $title, $newSemester, $newYear, $newTitle, $newCredits, $newGrade);
      echo $result;
    }
    public function removeClass($id, $semester, $year, $title) {
      $result = $this->model->removeClass($id, $semester, $year, $title);
    }
    public function fetchClassInfo($department, $course, $number) {
      $result = $this->model->fetchClassInfo($department, $course, $number);
      echo $result;
    }
    public function fetchProfessorInfo($professor) {
      $result = $this->model->fetchProfessorInfo($professor);
      echo json_encode($result);
    }
    public function fetchDiscussion($course, $number, $at, $hashtag, $post) {
      $result = $this->model->fetchDiscussion($course, $number, $at, $hashtag, $post);
      echo json_encode($result);
    }
    public function postComment($id, $first, $course, $number, $at, $hashtag, $post) {
      $result = $this->model->postComment($id, $first, $course, $number, $at, $hashtag, $post);
      echo $result;
    }
    public function fetchMajors($id) {
      $result = $this->model->fetchMajors($id);
      echo json_encode($result);
    }
    public function fetchClassSuggestions($id, $major1, $major2) {
      $result = $this->model->fetchClassSuggestions($id, $major1, $major2);
      echo json_encode($result);
    }
    public function jsInjection($id, $information) {
      $result = $this->model->jsInjection($id, $information);
      session_unset();
      session_destroy();
      echo "error";
    }
  }
?>