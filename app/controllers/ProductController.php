<?php

require_once MODEL . 'Product.php';

class ProductController
{

  protected $model;

  public function __construct()
  {
    $this->model = new Product;
  }
  public function index()
  {
    $products = $this->model->all();
    include_once ROOT . "app/views/products/index.php";
  }

  public function all()
  {
    return $this->model->all();
  }

  public function edit($id)
  {
    return $this->model->edit($id);
  }

  public function add()
  {
    include_once VIEW . "products/add.php";
  }


  public function delete($id)
  {
    $product = $this->model->edit($id);
    if ($product) {
      $this->model->destroy($id); // Assuming your model has a delete method
      return ['success' => true];
    } else {
      return ['success' => false];
    }
  }

}