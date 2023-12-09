<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use ArangoDBClient\Statement as ArangoStatement;
use ArangoDBClient\Connection as ArangoConnection;

class CategoryController extends Controller
{
  private $arangoConnection;
  public function __construct()
  {
    $arangoConfig = Config::get('arango');
    $this->arangoConnection = new ArangoConnection($arangoConfig);
  }

  public function index()
  {
    $statement = new ArangoStatement(
      $this->arangoConnection,
      [
        'query' => 'FOR i IN category RETURN i'
      ]
    );
    $cursor = $statement->execute()->getAll();
    return $cursor;
  }


  public function createCategory()
  {
    $name = request("name");
    $statement = new ArangoStatement(
      $this->arangoConnection,
      [
        'query' => 'INSERT {
          "name": @name,
        } IN category',
        'bindVars' => [
          'name' => $name,
        ]
      ]
    );
    $statement->execute();
    return redirect("/category");
  }

  public function updateCategory($id)
  {

    $name = request("name");
    $statement = new ArangoStatement(
      $this->arangoConnection,
      [
        'query' =>  'FOR u IN category 
            FILTER u._key == @key 
            UPDATE u WITH
            {
              "name": @name,
            }
            IN category RETURN NEW',
        'bindVars' => [
          'name' => $name,
          'key' => $id,
        ]
      ]
    );
    $statement->execute();
    return redirect()->back();
  }
  public function deleteCategory($id)
  {
    $statement = new ArangoStatement(
      $this->arangoConnection,
      [
        'query' => 'FOR u IN category FILTER u._key == @key REMOVE { _key: @key } IN category',
        'bindVars' => [
          'key' => $id,
        ]
      ]
    );
    $statement->execute();
    return redirect()->back();
  }
}
