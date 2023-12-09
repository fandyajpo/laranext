<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  @vite('resources/css/app.css')
</head>

<body class="bg-black">
  <div id="modal" style="display: none;" class="bg-black/20 backdrop-blur-sm absolute w-full h-full flex items-center justify-center">
    <div class="w-1/4 h-2/4 bg-white p-4">
      <button onclick="closeModal()" class="w-6 h-6">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
          <path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
      <form id="articleFormUpdate" method="POST" class="space-y-2 pb-2">
        @csrf
        @method('PATCH')
        <div>
          <input id="name" class="bg-white p-2 rounded-md" name="name" placeholder="Name" />
        </div>
        <div>
          <input id="writer" class="bg-white p-2 rounded-md" name="writer" placeholder="Writer" />
        </div>
        <button type="submit" class="bg-white h-8 w-24 rounded-md">Submit</button>
      </form>
    </div>
  </div>

  <div class="p-8">
    <form action="/article" method="POST" class="space-y-2 pb-2">
      @csrf
      <div>
        <input id="name" class="bg-white p-2 rounded-md" name="name" placeholder="Name" />
      </div>
      <div>
        <input id="writer" class="bg-white p-2 rounded-md" name="writer" placeholder="Writer" />
      </div>
      <button type="submit" class="bg-white h-8 w-24 rounded-md">Submit</button>
    </form>
    <table class="border-collapse border border-white w-full">
      <thead>
        <tr class="border border-slate-600 text-xs sm:text-base">
          <th class="border border-slate-600">Article Name</th>
          <th class="border border-slate-600">Writer</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($cursor as $d)
        <tr class="border border-slate-600 hover:bg-gray-900 duration-500 text-xs text-white">
          <td class="border border-slate-600 p-1">{{ $d->name }}</p>
          <td class="border border-slate-600 p-1">{{ $d->writer }}</p>
          <td class="border border-slate-600 p-1">
            <button type="button" onclick="articleForm('{{ $d->getKey() }}', '{{ $d->name }}', '{{ $d->writer }}')">Update</button </td>
          <td>
            <form action="/article/{{ $d->getKey() }}/" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>
<script>
  let modalOpen = false

  function articleForm(articleId, name, writer) {
    document.getElementById('name').value = name;
    document.getElementById('writer').value = writer;
    const form = document.getElementById('articleFormUpdate');
    form.action = `/article/${articleId}`;
    openModal()
  }

  function openModal() {
    modalOpen = true
    if (modalOpen) {
      document.getElementById('modal').style.display = "flex"
    } else {
      document.getElementById('modal').style.display = "none"
    }
  }

  function closeModal() {
    modalOpen = false
    if (modalOpen) {
      document.getElementById('modal').style.display = "flex"
    } else {
      document.getElementById('modal').style.display = "none"
    }
  }
</script>

</html>