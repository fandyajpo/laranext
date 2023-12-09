<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
  public function index()
  {
    return view("index");
  }
  public function user()
  {
    return view("user");
  }
  public function item()
  {
    return view("item.index");
  }
  public function category()
  {
    return view("category.index");
  }
}
