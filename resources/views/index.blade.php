<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body>
 <div >
 @for($i =0; $i < count ($cursor);$i++)
   <p>{{$cursor[$i]}}</p>
  @endfor

  {{$title}}

   @if(count($cursor) == 1)
   <p>Total item is {{count($cursor)}}</p>
   @elseif(count($cursor) > 1)
   <p>Alot item</p>
   @endif



</div>
</body>
</html>