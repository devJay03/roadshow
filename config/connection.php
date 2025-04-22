<?php

class Database
{

  private static $instance = null;
  private $conn;

  public function __construct()
  {
    try {
      require_once 'env.php';

      $dsn = "$type:host=$host;dbname=$dbname;charset=$charset";
      $this->conn = new PDO($dsn, $user, $pass);
      $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      throw new Exception('Connection Failed: ' . $e->getMessage());
    }
  }
  public static function getInstance()
  {
    if (!self::$instance) {
      self::$instance = new Database();
    }

    return self::$instance;
  }

  public function getConnection()
  {
    return $this->conn;
  }

}

