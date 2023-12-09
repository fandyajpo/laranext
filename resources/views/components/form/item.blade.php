<div class="px-4 items-center">
    <label>Product Name</label>
    <input id="product_name" name="product_name" class="border border-gray-400 rounded-md w-full p-2" />
</div>
<div class="px-4 items-center">
    <label>Category</label>
    <select id="category" name="category" class="border border-gray-400 rounded-md w-full p-2"></select>
</div>
<div class="px-4 items-center">
    <label>Harga</label>
    <input id="harga" name="harga" type="number" class="border border-gray-400 rounded-md w-full p-2" />
</div>
<div class="px-4 items-center pb-4">
    <label>Stock</label>
    <input id="stock" name="stock" type="number" class="border border-gray-400 rounded-md w-full p-2" />
</div>
<button type="submit" class="bg-yellow-500 w-full text-center h-10 text-white font-semibold">
    Submit
</button>

<script>
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

    async function populateCategories() {
        const selectElement = document.getElementById("category");
        const categories = await getItems();



        categories.map((category) => {
            selectElement.innerHTML += `
          <option class="border" value="${category._key}">
          ${category.name}
          </option>
      `;
        });
    }

    window.onload = populateCategories();
</script>