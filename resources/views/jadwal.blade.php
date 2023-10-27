<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
 
</head>
<body>
  <div class="bg-gradient-to-r from-teal-600 to-blue-500 w-full h-32 p-8 border-b border-teal-500 shadow-sm">
    <p class="text-white font-semibold">Nama: {{$username}}</p>
    <p class="text-white font-semibold">Nim: {{$nim}}</p>
    <hr/>
  </div>
  <div class="p-8 space-y-8">  
    <center class="text-xl font-semibold">Jadwal Matakuliah</center>
    <hr class="border-black shadow-sm" />
    <table class="border-collapse border border-slate-500 w-full">
     
      <thead>
        <tr class="border border-slate-600 text-xs sm:text-base">
          <th class="border border-slate-600">Matakuliah</th>
          <th class="border border-slate-600">Kelas</th>
          <th class="border border-slate-600">Enrolment Key</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $d)
        <tr class="border border-slate-600 hover:bg-gray-300 duration-500 text-xs">
          <td class="border border-slate-600 p-1">{{ $d->name }}</p>
          <td class="border border-slate-600 p-1">{{ $d->kelas }}</p>
          <td class="border border-slate-600 p-1 text-blue-500 hover:underline">{{ $d->enrolment }}</p>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
</body>
</html>