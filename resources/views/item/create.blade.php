@extends('layouts.app')

@section('content')
<div class="w-full h-screen py-8 space-y-2">
  <form action="/api/item" class="bg-white rounded-md overflow-hidden pt-4" method="POST">
    @csrf
    @method("POST")
    @include("components.form.item")
  </form>
</div>
@endsection


<script>
  //   async function getItems() {
  //     try {
  //       const request = await fetch("http://localhost:8000/0/api/category", {
  //         method: "GET",
  //       });
  //       const result = await request.json();
  //       return result;
  //     } catch (error) {
  //       return error;
  //     }
  //   }

  //   async function populateCategories() {
  //     const selectElement = document.getElementById("category");
  //     const categories = await getItems();

  //     categories.map(category => {
  //       selectElement.innerHTML += `
  //           <option class="border" value="${category._key}">
  //           ${category.name}
  //           </option>
  //       `;
  //     });

  //   }
  //   window.onload = populateCategories();
  // 
</script>