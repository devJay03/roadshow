<?php

require_once MODEL . 'Product.php';
require_once MODEL . 'Category.php';
require_once APP . 'Request/request.php';


class ProductController
{

  protected $model;
  protected $category;

  public function __construct()
  {
    $this->model = new Product;
    $this->category = new Category;
  }
  public function index()
  {
    $categories = $this->category->all();
    include_once ROOT . "app/views/product.php";
  }

  public function all()
  {
    return $this->model->all();
  }

  public function edit($id)
  {
    return $this->model->edit($id);
  }

  public function store()
  {
    $data = Request::all();
    $product = $this->model->store($data);
    if ($product) {
      return ['success' => true];
    } else {
      return ['success' => false];
    }
  }

  public function update($id)
  {
    $data = Request::all();
    $data['id'] = $id;

    $product = $this->model->update($data);
    if ($product) {
      return ['success' => true];
    } else {
      return ['success' => false];
    }

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