@extends('layouts.app')

@section('content')
<div class="w-full h-screen py-8 space-y-2">
  <form action="/api/category" class="bg-white rounded-md overflow-hidden pt-4" method="POST">
    @csrf
    @method("POST")
    @include("components.form.category")
  </form>
</div>
@endsection