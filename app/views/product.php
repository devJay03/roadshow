<style>
  .highlight {
    background-color: #66B2B2 !important;
    /* Light yellow highlight */
  }
</style>

<ul class="breadcrumb">
  <li><a href="#">Home</a></li>
  <li><a href="#">Pictures</a></li>
  <li><a href="#">Summer 15</a></li>
  <li>Italy</li>
</ul>

<div class="row">
  <div class="right">
    <div class="card">
      <div class="card-header">
        <h4 class="header-title">Products</h4>
        <div class="form-group">
          <input type="text" id="search" placeholder="search product..">
        </div>
      </div>
      <div class="card-body">
        <table id="product-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Product Name</th>
              <th>Category</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="product-body">

          </tbody>

        </table>
      </div>
    </div>
  </div>
  <div class="left">
    <div class="card">
      <div class="card-header">
        <h4 class="header-title">Products</h4>
        <a href="">Add</a>
      </div>
      <div class="card-body">
        <div class="form-container">
          <form class="product-form" id="product-form">
            <div class="form-group">
              <label for="name">Product Name</label>
              <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
              <label for="productPrice">Price</label>
              <input type="text" id="price" name="price" required>
            </div>


            <div class="form-group">
              <label for="productPrice">Quantity</label>
              <input type="number" id="quantity" name="quantity" required>
            </div>

            <div class="form-group">
              <label for="category_id">Category</label>
              <select id="category_id" name="category_id" required>
                <option> Select Category</option>
                <?php foreach ($categories as $category): ?>
                  <option value="<?= $category->id ?>"><?= $category->name ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <input type="hidden" id="id">
            <button type="button" id="cancel" class="submit-button">Cancel</button>
            <button type="submit" class="submit-button">Add Product</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="public/product.js"></script>