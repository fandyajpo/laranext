<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class jadwalController extends Controller
{
   public function index() {
      $username = "Fandy Ahmad Januar Pratama";
      $nim = "2201010181";

      $jsonFilePath = public_path('./jadwal.json');
      $jsonData = file_get_contents($jsonFilePath);
      $data = json_decode($jsonData);
      return view("jadwal",compact('data',"username","nim"));
   }
}
?>