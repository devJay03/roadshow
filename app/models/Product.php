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
  public function store($data)
  {
    $sql = 'INSERT INTO products (name, category_id, price, quantity) VALUES (:name, :category_id, :price, :quantity)';
    $stmt = $this->db->prepare($sql);
    return $stmt->execute($data);
  }

  public function edit($id)
  {
    $sql = 'SELECT * FROM products WHERE id = :id';
    $stmt = $this->db->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
  }

  public function update($data)
  {
    $sql = 'UPDATE products SET name = :name, category_id = :category_id, price = :price, quantity = :quantity WHERE id = :id';
    $stmt = $this->db->prepare($sql);
    return $stmt->execute($data);
  }


  public function destroy($id)
  {
    $sql = 'DELETE FROM products WHERE id = :id';
    $stmt = $this->db->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->rowCount();
  }

}