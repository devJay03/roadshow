<?php

require_once ROOT . 'config/connection.php';

class Category
{
  protected $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
  }

  public function all()
  {
    $stmt = $this->db->query('SELECT * FROM categories');
    return $stmt->fetchAll();
  }
}