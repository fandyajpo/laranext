<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{
  public function index()
  {
    return view("auth.index");
  }
  public function auth()
  {
    response('Hello World')->cookie('fandy', 'helloworld');
    return redirect()->back();
  }
}
