<?php
require_once ROOT . "config/connection.php";

class Product
{
  protected $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
  }

  public function all()
  {
    $sql = 'SELECT products.*, categories.name AS category_name FROM products LEFT JOIN categories ON products.category_id = categories.id';
    $stmt = $this->db->query($sql);
    return $stmt->fetchAll();
  }

  public function edit($id)
  {
    $sql = 'SELECT * FROM products WHERE id = :id';
    $stmt = $this->db->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
  }

  public function destroy($id)
  {
    $sql = 'DELETE FROM products WHERE id = :id';
    $stmt = $this->db->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->rowCount();
  }

}