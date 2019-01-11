<?php
  // DRA
  require_once __DIR__.'/vendor/autoload.php';
  require_once('/var/www/.secrets.php');
  class Login {
    private $connection;
    function __construct() {
      $this->connection = new mysqli(Secrets::$host, Secrets::$username, Secrets::$password, Secrets::$dbname);
      if ($this->connection->connect_error) {
        die($this->connection->connect_error);
      }
    }
    public function verify($id, $password) {
      $prepared = $this->connection->prepare(
        "SELECT password FROM students WHERE computing_id = ? AND computing_id NOT IN (SELECT computing_id FROM attackers)"
      );
      $prepared->bind_param('s', $id);
      $prepared->execute();
      $prepared->bind_result($db_password);
      $prepared->fetch();
      if (hash('sha512', $password) != $db_password) {
        throw new Exception("");
      }
      else {
        return true;
      }
    }
  }
?>