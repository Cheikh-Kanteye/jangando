<?php
class DatabaseConnection
{
  private static $instance = null;
  private $connection;

  private function __construct()
  {
    $dsn = "mysql:host=localhost;dbname=jangando;charset=utf8";
    $username = "root";
    $password = "";
    $this->connection = new PDO($dsn, $username, $password, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
  }

  public static function getInstance()
  {
    if (self::$instance === null) {
      self::$instance = new DatabaseConnection();
    }
    return self::$instance;
  }

  public function getConnection()
  {
    return $this->connection;
  }
}
