<div id="itemModal" style="display: none;" class="absolute w-full h-full justify-center items-center bg-black/20 backdrop-blur-sm z-10">
  <form class="bg-white rounded-md" method="POST" id="updateForm">
    @csrf
    @method("PATCH")
    <div class="p-4">
      <button type="button" onclick="handleClose()" class="w-6 h-6 bg-red-500 flex items-center justify-center text-white rounded-full">
        x
      </button>
    </div>
    <p class="text-xl pl-4 py-2">Edit Category</p>
    @include("components.form.category")
  </form>
</div>
@extends('layouts.app') @section('content')
<div class="w-full py-8 space-y-2">
  <a href="/category/create">
    <div class="p-2 bg-yellow-500 rounded-md w-32 text-center text-white">
      Create New
    </div>
  </a>
  <table class="item-table table-fixed w-full bg-white rounded-md overflow-hidden">
    <thead>
      <tr class="border">
        <th class="border p-2">Name</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>

@endsection

<script>
  function handleOpen(name, key) {
    document.getElementById("itemModal").style.display = "flex";
    document.getElementById("name").value = name;
    const form = document.getElementById("updateForm");
    form.action = `/api/category/${key}`;
  }

  function handleClose() {
    document.getElementById("itemModal").style.display = "none";
  }

  async function getItems() {
    try {
      const request = await fetch("http://localhost:8000/api/category", {
        method: "GET",
      });
      const result = await request.json();
      return result;
    } catch (error) {
      return error;
    }
  }

  async function delCategory(id) {
    const csrfToken = document.querySelector(
      'meta[name="csrf-token"]'
    ).content;
    try {
      const request = await fetch(
        `http://localhost:8000/api/category/${id}`, {
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

    items.forEach((item) => {
      tableBody.innerHTML += `
          <tr class="border">
            <td class="border p-2">${item.name}</td>
            <td class="border p-2 flex justify-around">
              <button type="button" onclick="handleOpen('${item.name}','${item._key}')">Update</button>
              <button type="button" onclick="delCategory(${item._key})">Delete</button>
            </td>
          </tr>
      `;
    });
  }

  window.onload = renderTable();
</script>