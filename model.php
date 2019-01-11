<?php
  // DRA
  require_once __DIR__.'/vendor/autoload.php';
  require_once('/var/www/.secrets.php');
  class Model {
    private $connection;
    function __construct() {
      $this->connection = new mysqli(Secrets::$host, Secrets::$username, Secrets::$password, Secrets::$dbname);
      if ($this->connection->connect_error) {
        die($this->connection->connect_error);
      }
    }
    public function getFirstName($id) {
      $prepared = $this->connection->prepare(
        "SELECT first_name FROM students WHERE computing_id = ?"
      );
      $prepared->bind_param('s', $id);
      $prepared->execute();
      $prepared->bind_result($first);
      $prepared->fetch();
      return $first;
    }
    public function createAccount($id, $first, $last, $password, $career, $program, $area1, $area2) {
      $prepared = $this->connection->prepare(
        "SELECT * FROM students WHERE computing_id = ?"
      );
      $prepared->bind_param('s', $id);
      $prepared->execute();
      $result = $prepared->get_result();
      $data = array();
      while ($row = $result->fetch_assoc()) {
        array_push($data, $row);
      }
      if (sizeof($data) == 0) {
        $prepared = $this->connection->prepare(
          "INSERT INTO students (computing_id, first_name, last_name, career, academic_program, area_of_study_1, area_of_study_2, timestamp, password) VALUES (?, ?, ?, ?, ?, ?, ?, CAST(now() AS DATETIME), ?)"
        );
        $prepared->bind_param('ssssssss', $id, $first, $last, $career, $program, $area1, $area2, $password);
        $prepared->execute();
	return "pass";
      }
      else {
        return "fail";
      }
    }
    public function fetchData($id) {
      $prepared = $this->connection->prepare(
        "SELECT computing_id, first_name, last_name, career, academic_program, area_of_study_1, area_of_study_2 FROM students WHERE computing_id = ?"
      );
      $prepared->bind_param('s', $id);
      $prepared->execute();
      $result = $prepared->get_result();
      $data = array();
      while ($row = $result->fetch_assoc()) {
        array_push($data, $row);
      }
      return $data;
    }
    public function editData($id, $password, $career, $program, $area1, $area2) {
      if ($password != "") {
        $prepared = $this->connection->prepare(
	  "UPDATE students SET password = ?, career = ?, academic_program = ?, area_of_study_1 = ?, area_of_study_2 = ? WHERE computing_id = ?"
	);
	$prepared->bind_param('ssssss', $password, $career, $program, $area1, $area2, $id);
	$prepared->execute();
      }
      else {
        $prepared = $this->connection->prepare(
	  "UPDATE students SET career = ?, academic_program = ?, area_of_study_1 = ?, area_of_study_2 = ? WHERE computing_id = ?"
	);
	$prepared->bind_param('sssss', $career, $program, $area1, $area2, $id);
	$prepared->execute();
      }
    }
    public function fetchClasses($id) {
      $prepared = $this->connection->prepare(
        "SELECT semester, year, title, credits, grade FROM classes WHERE computing_id = ? ORDER BY year DESC, CASE semester WHEN 'Fall' THEN 1 WHEN 'Summer' THEN 2 WHEN 'Spring' THEN 3 WHEN 'January' THEN 4 END, title ASC"
      );
      $prepared->bind_param('s', $id);
      $prepared->execute();
      $result = $prepared->get_result();
      $data = array();
      while ($row = $result->fetch_assoc()) {
        array_push($data, $row);
      }
      return $data;
    }
    public function addClass($id, $semester, $year, $title, $credits, $grade) {
      $prepared = $this->connection->prepare(
        "SELECT * FROM classes WHERE computing_id = ? AND semester = ? AND year = ? AND title = ?"
      );
      $prepared->bind_param('ssis', $id, $semester, $year, $title);
      $prepared->execute();
      $result = $prepared->get_result();
      $data = array();
      while ($row = $result->fetch_assoc()) {
        array_push($data, $row);
      }
      if (sizeof($data) == 0) {
        $prepared = $this->connection->prepare(
          "INSERT INTO classes (computing_id, semester, year, title, credits, grade) VALUES (?, ?, ?, ?, ?, ?)"
        );
        $prepared->bind_param('ssisis', $id, $semester, $year, $title, $credits, $grade);
        $prepared->execute();
	return "pass";
      }
      else {
        return "fail";
      }
    }
    public function editClass($id, $semester, $year, $title, $newSemester, $newYear, $newTitle, $newCredits, $newGrade) {
      $prepared = $this->connection->prepare(
	"DELETE FROM classes WHERE computing_id = ? AND semester = ? AND year = ? AND title = ?"
      );
      $prepared->bind_param('ssis', $id, $semester, $year, $title);
      $prepared->execute();
      $prepared = $this->connection->prepare(
        "SELECT * FROM classes WHERE computing_id = ? AND semester = ? AND year = ? AND title = ?"
      );
      $prepared->bind_param('ssis', $id, $newSemester, $newYear, $newTitle);
      $prepared->execute();
      $result = $prepared->get_result();
      $data = array();
      while ($row = $result->fetch_assoc()) {
        array_push($data, $row);
      }
      if (sizeof($data) == 0) {
        $prepared = $this->connection->prepare(
          "INSERT INTO classes (computing_id, semester, year, title, credits, grade) VALUES (?, ?, ?, ?, ?, ?)"
        );
        $prepared->bind_param('ssisis', $id, $newSemester, $newYear, $newTitle, $newCredits, $newGrade);
        $prepared->execute();
	return "pass";
      }
      else {
        return "fail";
      }
    }
    public function removeClass($id, $semester, $year, $title) {
      $prepared = $this->connection->prepare(
	"DELETE FROM classes WHERE computing_id = ? AND semester = ? AND year = ? AND title = ?"
      );
      $prepared->bind_param('ssis', $id, $semester, $year, $title);
      $prepared->execute();
    }
    public function fetchClassInfo($department, $course, $number) {
      $USER_EMAIL = '';
      $USER_PASSWORD = '';
      $COOKIE = '/var/www/.cookies.txt';
      $URL = 'https://thecourseforum.com/users/sign_in';
      $AGENT = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36';
      $curl = curl_init();
      $HEADERS[] = "Accept: */*";
      $HEADERS[] = "Connection: Keep-Alive";
      curl_setopt($curl, CURLOPT_HTTPHEADER, $HEADERS);
      curl_setopt($curl, CURLOPT_HEADER, 0);
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($curl, CURLOPT_USERAGENT, $AGENT);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($curl, CURLOPT_COOKIEFILE, $COOKIE);
      curl_setopt($curl, CURLOPT_COOKIEJAR, $COOKIE);
      curl_setopt($curl, CURLOPT_REFERER, $URL);
      curl_setopt($curl, CURLOPT_URL, $URL);
      $content = curl_exec($curl);
      preg_match('/<input type="hidden" name="authenticity_token" value="[^\s"]*"/', $content, $matches);
      preg_match_all('/[^\s"]*/', $matches[0], $tokens);
      $token = $tokens[0][14];
      $postValues = array(
        'utf8' => '✓',
        'user[email]' => Secrets::$email,
	'user[password]' => Secrets::$password,
	'user[remember_me]' => "1",
	'commit' => 'Login',
	'authenticity_token' => $token
      );
      $POSTFIELDS = http_build_query($postValues);
      $URL = 'https://thecourseforum.com/users/sign_in';
      curl_setopt($curl, CURLOPT_URL, $URL);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $POSTFIELDS);
      $content = curl_exec($curl);
      $URL = 'https://thecourseforum.com/departments/' . $department;
      curl_setopt($curl, CURLOPT_URL, $URL);
      $content = curl_exec($curl);
      $regex = '/<a href="\/courses\/[\d]*\/professors"><div class="row course-name">' . $course . ' ' . $number . '<\/div>/';
      preg_match($regex, $content, $matches);
      if (sizeof($matches) > 0) {
        preg_match('/[\d]+/', $matches[0], $codes);
	if (sizeof($codes) > 0) {
	  $code = $codes[0];
	  $URL = 'https://thecourseforum.com/courses/' . $code . '/professors';
	  curl_setopt($curl, CURLOPT_URL, $URL);
	  $content = curl_exec($curl);
	  return $content;
	}
      }
      else {
        return "";
      }
    }
    public function fetchProfessorInfo($professor) {
      $USER_EMAIL = '';
      $USER_PASSWORD = '';
      $COOKIE = '/var/www/.cookies.txt';
      $URL = 'https://thecourseforum.com/users/sign_in';
      $AGENT = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36';
      $curl = curl_init();
      $HEADERS[] = "Accept: */*";
      $HEADERS[] = "Connection: Keep-Alive";
      curl_setopt($curl, CURLOPT_HTTPHEADER, $HEADERS);
      curl_setopt($curl, CURLOPT_HEADER, 0);
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($curl, CURLOPT_USERAGENT, $AGENT);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($curl, CURLOPT_COOKIEFILE, $COOKIE);
      curl_setopt($curl, CURLOPT_COOKIEJAR, $COOKIE);
      curl_setopt($curl, CURLOPT_REFERER, $URL);
      curl_setopt($curl, CURLOPT_URL, $URL);
      $content = curl_exec($curl);
      preg_match('/<input type="hidden" name="authenticity_token" value="[^\s"]*"/', $content, $matches);
      preg_match_all('/[^\s"]*/', $matches[0], $tokens);
      $token = $tokens[0][14];
      $postValues = array(
        'utf8' => '✓',
        'user[email]' => Secrets::$email,
	'user[password]' => Secrets::$password,
	'user[remember_me]' => "1",
	'commit' => 'Login',
	'authenticity_token' => $token
      );
      $POSTFIELDS = http_build_query($postValues);
      $URL = 'https://thecourseforum.com/users/sign_in';
      curl_setopt($curl, CURLOPT_URL, $URL);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $POSTFIELDS);
      $content = curl_exec($curl);
      $getProfessor = "";
      for ($i = 0; $i < strlen($professor); $i++) {
        if ($professor[$i] == ' ') {
	  $getProfessor .= '+';
	}
	else if ($professor[$i] == "'") {
	  $getProfessor .= '%27';
	}
	else {
	  $getProfessor .= $professor[$i];
	}
      }
      $URL = 'https://thecourseforum.com/search/search?utf8=%E2%9C%93&query=' . $getProfessor . '&button=';
      curl_setopt($curl, CURLOPT_URL, $URL);
      $content = curl_exec($curl);
      $regex = '/<div class="col-xs-12"><a data-no-turbolink="" href="[A-Za-z0-9\/]*"><div class="col-xs-12">' . $professor . '<\/div><\/a><\/div>/i';
      preg_match_all($regex, $content, $matches);
      if (sizeof($matches) > 0) {
        $professorNumbers = array();
        for ($i = 0; $i < sizeof($matches[0]); $i++) {
	  preg_match_all('/[^A-Za-z\s<>="-\/]+/', $matches[0][$i], $number);
	  array_push($professorNumbers, $number[0][1]);
	}
        $contents = array(
          'classes' => array(),
          'ratings' => array(),
          'difficulties' => array(),
          'gpas' => array()
        );
        for ($i = 0; $i < sizeof($professorNumbers); $i++) {
          $URL = 'https://thecourseforum.com/professors/' . $professorNumbers[$i];
          curl_setopt($curl, CURLOPT_URL, $URL);
          $content = curl_exec($curl);
          preg_match_all('/<div class="row course-title">[^<>]*<\/div><\/a>/', $content, $classes);
          for ($j = 0; $j < sizeof($classes[0]); $j++) {
            preg_match_all('/[^<>]+/', $classes[0][$j], $class);
            array_push($contents['classes'], $class[0][1]);
          }
          preg_match_all('/<h4 class="[a-z-]*">[\d\.-]*<\/h4>/', $content, $match1);
          for ($j = 0; $j < sizeof($match1[0]); $j++) {
            preg_match('/([\d]+\.[\d]+|--)/', $match1[0][$j], $match2);
            if ($j % 3 == 0) {
              array_push($contents['ratings'], $match2[0]);
            }
            else if ($j % 3 == 1) {
              array_push($contents['difficulties'], $match2[0]);
            }
            else {
              array_push($contents['gpas'], $match2[0]);
            }
          }
        }
        return $contents;
      }
      else {
        return "";
      }
    }
    public function fetchDiscussion($course, $number, $at, $hashtag, $post) {
      $prepared = $this->connection->prepare(
        "DELETE FROM discussions WHERE timestamp <= now() - interval 7 day"
      );
      $prepared->execute();
      $allCourses = 0;
      $allNumbers = 0;
      $allAts = 0;
      $allHashtags = 0;
      $allPosts = 0;
      if ($course == "") {
        $allCourses = 1;
      }
      if ($number == "") {
        $allNumbers = 1;
      }
      if ($at == "") {
        $allAts = 1;
      }
      if ($hashtag == "") {
        $allHashtags = 1;
      }
      if ($post == "%%") {
        $allPosts = 1;
      }
      $prepared = $this->connection->prepare(
        "SELECT computing_id, first_name, timestamp, course, number, at, hashtag, post FROM discussions WHERE (course = ? OR ?) AND (number = ? OR ?) AND (computing_id = ? OR at = ? OR ?) AND (hashtag = ? OR ?) AND (post LIKE ? OR ?) ORDER BY timestamp DESC"
      );
      $prepared->bind_param('sssssssssss', $course, $allCourses, $number, $allNumbers, $at, $at, $allAts, $hashtag, $allHashtags, $post, $allPosts);
      $prepared->execute();
      $result = $prepared->get_result();
      $data = array();
      while ($row = $result->fetch_assoc()) {
        array_push($data, $row);
      }
      return $data;
    }
    public function postComment($id, $first, $course, $number, $at, $hashtag, $post) {
      $prepared = $this->connection->prepare(
        "INSERT INTO discussions (computing_id, first_name, timestamp, course, number, at, hashtag, post) VALUES (?, ?, now() - interval 5 hour, ?, ?, ?, ?, ?)"
      );
      $prepared->bind_param('sssssss', $id, $first, $course, $number, $at, $hashtag, $post);
      $prepared->execute();
      return "pass";
    }
    public function fetchMajors($id) {
      $prepared = $this->connection->prepare(
        "SELECT area_of_study_1, area_of_study_2 FROM students WHERE computing_id = ?"
      );
      $prepared->bind_param('s', $id);
      $prepared->execute();
      $result = $prepared->get_result();
      $data = array();
      while ($row = $result->fetch_assoc()) {
        array_push($data, $row);
      }
      return $data;
    }
    public function fetchClassSuggestions($id, $major1, $major2) {
      $prepared = $this->connection->prepare(
        "SELECT title FROM classes WHERE computing_id != ? AND title NOT IN (SELECT title FROM classes WHERE computing_id = ?) AND computing_id IN (SELECT computing_id FROM students WHERE ((area_of_study_1 = ? OR area_of_study_1 = ? OR area_of_study_2 = ? OR area_of_study_2 = ?) AND computing_id != ?)) UNION ALL SELECT title FROM classes WHERE computing_id != ? AND title NOT IN (SELECT title FROM classes WHERE computing_id = ?) AND computing_id IN (SELECT computing_id FROM students WHERE (((area_of_study_1 = ? AND area_of_study_2 = ?) OR (area_of_study_1 = ? AND area_of_study_2 = ?)) AND computing_id != ?))"
      );
      $prepared->bind_param('ssssssssssssss', $id, $id, $major1, $major2, $major1, $major2, $id, $id, $id, $major1, $major2, $major2, $major1, $id);
      $prepared->execute();
      $result = $prepared->get_result();
      $data = array();
      while ($row = $result->fetch_assoc()) {
        array_push($data, $row);
      }
      return $data;
    }
    public function jsInjection($id, $information) {
      $prepared = $this->connection->prepare(
        "INSERT INTO attackers (computing_id, information, timestamp) VALUES (?, ?, CAST(now() AS DATETIME))"
      );
      $prepared->bind_param('ss', $id, $information);
      $prepared->execute();
    }
  }
?>