<div id="itemModal" style="display: none;" class="absolute w-full flex h-full justify-center items-center bg-black/20 backdrop-blur-sm z-10">
  <form class="bg-white rounded-md" method="POST" id="updateForm">
    @csrf
    @method("PATCH")
    <div class="p-4">
      <button type="button" onclick="handleClose()" class="w-6 h-6 bg-red-500 flex items-center justify-center text-white rounded-full">
        x
      </button>
    </div>
    <p class="text-xl pl-4 py-2">Edit Item</p>
    @include("components.form.item")
  </form>
</div>
@extends('layouts.app') @section('content')
<div class="w-full py-8 space-y-2">
  <a href="/item/create">
    <div class="p-2 bg-yellow-500 rounded-md w-32 text-center text-white">
      Create New
    </div>
  </a>
  <table class="item-table table-fixed w-full bg-white rounded-md overflow-hidden">
    <thead>
      <tr class="border">
        <th class="border p-2">Name</th>
        <th class="border p-2">Category</th>
        <th class="border p-2">Harga</th>
        <th class="border p-2">Stock</th>
        <th class="border p-2">Action</th>
      </tr>
    </thead>
    <tbody />
  </table>
</div>

@endsection

<script>
  function handleOpen(pName, cat, harga, stock, key) {
    document.getElementById("itemModal").style.display = "flex";
    document.getElementById("category").value = cat
    document.getElementById("product_name").value = pName;
    document.getElementById("harga").value = harga;
    document.getElementById("stock").value = stock;
    const form = document.getElementById("updateForm");
    form.action = `/api/item/${key}`;
  }

  function handleClose() {
    document.getElementById("itemModal").style.display = "none";
  }

  async function getItems() {
    try {
      const request = await fetch("http://localhost:8000/api/item", {
        method: "GET",
      });
      const result = await request.json();
      return result;
    } catch (error) {
      return error;
    }
  }

  async function delItem(id) {
    const csrfToken = document.querySelector(
      'meta[name="csrf-token"]'
    ).content;
    try {
      const request = await fetch(
        `http://localhost:8000/api/item/${id}`, {
          method: "DELETE",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
          },
        }
      );
      return window.location.reload();
    } catch (error) {
      return error;
    }
  }

  async function renderTable() {
    const items = await getItems();
    const tableBody = document.querySelector(".item-table tbody");

    return items.forEach((item) => {
      tableBody.innerHTML += `
          <tr class="border">
            <td class="border p-2">${item.product_name}</td>
            <td class="border p-2">${item.category.name ? item.category.name : item.category}</td>
            <td class="border p-2">${item.harga}</td>
            <td class="border p-2">${item.stock}</td>
            <td class="border p-2 flex justify-around">
              <button type="button" onclick="handleOpen('${item.product_name}','${item.category._key}','${item.harga}','${item.stock}','${item._key}')">Update</button>
              <button type="button" onclick="delItem(${item._key})">Delete</button>
            </td>
          </tr>
      `;
    });
  }

  window.onload = renderTable();
</script>