<style>
  /* Custom Styles for Form */
  .form-container {
    margin-top: 20px;
  }

  .product-form .form-group label {
    font-weight: bold;
    color: #333;
  }

  .product-form input,
  .product-form select,
  .product-form textarea {
    border-radius: .375rem;
    padding: 0.75rem;
    border: 1px solid #ced4da;
    font-size: 1rem;
    width: 100%;
  }

  .product-form textarea {
    resize: vertical;
  }

  .submit-button {
    background-color: #007bff;
    color: white;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: .375rem;
    cursor: pointer;
  }

  .submit-button:hover {
    background-color: #0056b3;
  }

  .form-group {
    margin-bottom: 1.25rem;
  }

  .card-header h4 {
    margin-bottom: 0;
  }

  .card-header a {
    text-decoration: none;
    padding: 8px 16px;
    background-color: #28a745;
    color: white;
    border-radius: 5px;
  }

  .card-header a:hover {
    background-color: #218838;
  }
</style>

<div class="row">
  <div class="right">
    <div class="card">
      <div class="card-header">
        <h4 class="header-title">Products</h4>
        <a href="">Add</a>
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
          <tbody>
            <?php foreach ($products as $index => $product): ?>
              <tr id="product-<?= $product->id ?>">
                <td><?= $index++ ?></td>
                <td><?= $product->name ?></td>
                <td><?= $product->category_name ?></td>
                <td><?= $product->quantity ?></td>
                <td><?= $product->price ?></td>
                <td>

                  <button onclick="edit(<?= $product->id ?>)">EDIT</button>
                  <button onclick="deleteProduct(<?= $product->id ?>)">DELETE</button>
                </td>
              </tr>
            <?php endforeach; ?>
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
          <form class="product-form">
            <div class="form-group">
              <label for="productName">Product Name</label>
              <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
              <label for="productDescription">Description</label>
              <textarea id="productDescription" name="productDescription" rows="4" required></textarea>
            </div>
            <div class="form-group">
              <label for="productPrice">Price ($)</label>
              <input type="number" id="productPrice" name="productPrice" required>
            </div>
            <div class="form-group">
              <label for="productCategory">Category</label>
              <select id="productCategory" name="productCategory" required>
                <option value="">Select a category</option>
                <option value="electronics">Electronics</option>
                <option value="clothing">Clothing</option>
                <option value="home">Home</option>
                <option value="toys">Toys</option>
              </select>
            </div>
            <button type="submit" class="submit-button">Add Product</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  function edit(id) {
    fetch('?url=api/product/edit/' + id)
      .then(response => response.json())
      .then(data => {
        document.getElementById('name').value = data.name;
      })
      .catch(error => console.error('Error:', error));
  }

  function deleteProduct(id) {
    fetch('?url=api/product/delete/' + id, {
      method: 'DELETE',
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          document.getElementById('product-' + id).remove();
        } else {
          alert('Failed to delete product');
        }
      })
      .catch(error => console.error('Error:', error));
  }



</script>