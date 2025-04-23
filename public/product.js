let allProducts = [];

$(document).ready(function () {
  getProducts();

  $('#search').on('input', function () {
    const query = $(this).val();
    filterAndDisplayProducts(query);
  });

  $('#cancel').on('click', function (e) {
    e.preventDefault();

    $('#product-form')[0].reset();
    $('#id').val();
    $('tr').removeClass('highlight'); // Remove highlight

  })

  $('#product-form').on('submit', function (e) {
    e.preventDefault();
    var id = $('#id').val();
    var url = id ? '?url=api/product/update/' + id : '?url=api/product/store';

    fetch(url, {
      method: 'POST',
      body: new FormData(this)
    })
      .then(res => res.json())
      .then(data => {
        console.log('Saved:', data);

        this.reset();
        $('tr').removeClass('highlight'); // Remove highlight

        $('#id').val();
        getProducts(true);
      })
      .catch(err => console.error('Error:', err));
  });

  $(document).on('click', '.edit', function (e) {
    e.preventDefault()
    $('#id').val($(this).data('id'));
    $('#name').val($(this).data('name'));
    $('#price').val($(this).data('price'));
    $('#quantity').val($(this).data('quantity'));
    $('#category_id').val($(this).data('category'))

    $('tr').removeClass('highlight'); // Remove from all
    $(this).closest('tr').addClass('highlight'); // Add to current
  })

});

function getProducts(forceRefresh = false) {
  if (forceRefresh || allProducts.length === 0) {
    fetch('?url=api/product/all')
      .then(res => res.json())
      .then(data => {
        allProducts = data;
        filterAndDisplayProducts('');
      });
  } else {
    filterAndDisplayProducts('');
  }
}


async function deleteProduct(id) {
  await fetch('?url=api/product/delete/' + id, {
    method: 'POST',
  });
  $('#product-form')[0].reset();
  $('#id').val();
  getProducts();
}


function filterAndDisplayProducts(query) {
  const filteredData = allProducts.filter(p => {
    return p.name.toLowerCase().includes(query.toLowerCase()) ||
      p.category_name.toLowerCase().includes(query.toLowerCase());
  });

  const body = document.getElementById('product-body');
  body.innerHTML = filteredData.length ?
    filteredData.map((p, i) => `
      <tr>
        <td>${i + 1}</td>
        <td>${p.name}</td>
        <td>${p.category_name}</td>
        <td>${p.price}</td>
        <td>${p.quantity}</td>
        <td>
          <button
            class="btn bg-success edit"
            data-id="${p.id}" 
            data-name="${p.name}" 
            data-category="${p.category_id}" 
            data-price="${p.price}" 
            data-quantity="${p.quantity}">Edit</button>
          <button class="btn bg-danger" onclick="deleteProduct(${p.id})">Delete</button>
        </td>
      </tr>
    `).join('') :
    '<tr><td colspan="6" class="text-center">No product found</td></tr>';
}