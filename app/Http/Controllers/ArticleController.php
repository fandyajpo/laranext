<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use ArangoDBClient\Statement as ArangoStatement;
use ArangoDBClient\Connection as ArangoConnection;

class ArticleController extends Controller
{
   private $arangoConnection;
   public function __construct()
   {
      $arangoConfig = Config::get('arango');
      $this->arangoConnection = new ArangoConnection($arangoConfig);
   }

   public function article()
   {
      $statement = new ArangoStatement(
         $this->arangoConnection,
         [
            'query' => 'FOR i IN book RETURN i'
         ]
      );
      $cursor = $statement->execute()->getAll();
      return view("article", compact("cursor"));
   }

   public function index()
   {
      $username = "Fandy Ahmad Januar Pratama";
      $nim = "2201010181";
      $jsonFilePath = public_path('./jadwal.json');
      $jsonData = file_get_contents($jsonFilePath);
      $data = json_decode($jsonData);
      return view("jadwal", compact('data', "username", "nim"));
   }

   public function createArticle()
   {
      $name = request("name");
      $writer = request("writer");

      $statement = new ArangoStatement(
         $this->arangoConnection,
         [
            'query' => 'INSERT {
               "name": @name,
               "writer": @writer
             } IN book',
            'bindVars' => [
               'name' => $name,
               'writer' => $writer,
            ]
         ]
      );
      $statement->execute();
      return redirect()->back();
   }

   public function updateArticle($key)
   {
      $name = request("name");
      $writer = request("writer");
      $statement = new ArangoStatement(
         $this->arangoConnection,
         [
            'query' =>  'FOR u IN book 
            FILTER u._key == @key 
            UPDATE u WITH
             { 
              name: @name,
              writer: @writer,
             } 
            IN book RETURN NEW',
            'bindVars' => [
               'name' => $name,
               'writer' => $writer,
               'key' => $key
            ]
         ]
      );
      $statement->execute();
      return redirect()->back();
   }
   public function deleteArticle($key)
   {
      $statement = new ArangoStatement(
         $this->arangoConnection,
         [
            'query' => 'FOR u IN book FILTER u._key == @key REMOVE { _key: @key } IN book',
            'bindVars' => [
               'key' => $key,
            ]
         ]
      );
      $statement->execute();
      return redirect()->back();
   }
}
