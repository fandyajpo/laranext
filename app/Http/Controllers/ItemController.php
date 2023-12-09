<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use ArangoDBClient\Statement as ArangoStatement;
use ArangoDBClient\Connection as ArangoConnection;

class ItemController extends Controller
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
        'query' => 'FOR item IN item
        LET category = (
          FOR c IN category
            FILTER c._key == item.category
            RETURN { name: c.name, _key: c._key }
        )
        RETURN {
          product_name: item.product_name,
          category: category[0] ? category[0] : "Not set",
          harga: item.harga,
          stock: item.stock,
          _key: item._key
        }'
      ]
    );
    $cursor = $statement->execute()->getAll();
    return $cursor;
  }


  public function createItem()
  {
    $product_name = request("product_name");
    $category = request("category");
    $harga = request("harga");
    $stock = request("stock");

    $statement = new ArangoStatement(
      $this->arangoConnection,
      [
        'query' => 'INSERT {
          "product_name": @product_name,
          "category": @category,
          "harga": @harga,
          "stock": @stock
        } IN item',
        'bindVars' => [
          'product_name' => $product_name,
          'category' => $category,
          'harga' => (int)$harga,
          'stock' => (int)$stock,
        ]
      ]
    );
    $statement->execute();
    return redirect("/item");
  }

  public function updateItem($id)
  {
    $product_name = request("product_name");
    $category = request("category");
    $harga = request("harga");
    $stock = request("stock");
    $statement = new ArangoStatement(
      $this->arangoConnection,
      [
        'query' =>  'FOR u IN item 
            FILTER u._key == @key 
            UPDATE u WITH
            {
              "product_name": @product_name,
              "category": @category,
              "harga": @harga,
              "stock": @stock
            }
            IN item RETURN NEW',
        'bindVars' => [
          'product_name' => $product_name,
          "category" => $category,
          'harga' => $harga,
          'stock' => $stock,
          'key' => $id,
        ]
      ]
    );
    $statement->execute();
    return redirect('/item');
  }
  public function deleteItem($id)
  {
    $statement = new ArangoStatement(
      $this->arangoConnection,
      [
        'query' => 'FOR u IN item FILTER u._key == @key REMOVE { _key: @key } IN item',
        'bindVars' => [
          'key' => $id,
        ]
      ]
    );
    $statement->execute();
    return redirect()->back();
  }
}



 

// namespace App\Http\Controllers;

// use Illuminate\Support\Facades\Config;
// use ArangoDBClient\Statement as ArangoStatement;
// use ArangoDBClient\Connection as ArangoConnection;

// class ItemController extends Controller
// {
//   private $arangoConnection;
//   public function __construct()
//   {
//     $arangoConfig = Config::get('arango');
//     $this->arangoConnection = new ArangoConnection($arangoConfig);
//   }

//   public function index()
//   {
//     $statement = new ArangoStatement(
//       $this->arangoConnection,
//       [
//         'query' => 'FOR i IN item RETURN i'
//       ]
//     );
//     $cursor = $statement->execute()->getAll();
//     return $cursor;
//   }


//   public function createItem()
//   {
//     $product_name = request("product_name");
//     $category = request("category");
//     $harga = request("harga");
//     $stock = request("stock");

//     $statement = new ArangoStatement(
//       $this->arangoConnection,
//       [
//         'query' => 'INSERT {
//           "product_name": @product_name,
//           "category": @category,
//           "harga": @harga,
//           "stock": @stock
//         } IN item',
//         'bindVars' => [
//           'product_name' => $product_name,
//           'category' => $category,
//           'harga' => $harga,
//           'stock' => $stock,
//         ]
//       ]
//     );
//     return $statement->execute();
//   }

//   public function updateItem($id)
//   {
//     $product_name = request("product_name");
//     $category = request("category");
//     $harga = request("harga");
//     $stock = request("stock");
//     $statement = new ArangoStatement(
//       $this->arangoConnection,
//       [
//         'query' =>  'FOR u IN item 
//             FILTER u._key == @key 
//             UPDATE u WITH
            // {
            //   "product_name": @product_name,
            //   "category": @category,
            //   "harga": @harga,
            //   "stock": @stock
            // }
//             IN item RETURN NEW',
//         'bindVars' => [
          // 'product_name' => $product_name,
          // 'category' => $category,
          // 'harga' => $harga,
          // 'stock' => $stock,
          // 'key' => $id,
//         ]
//       ]
//     );
//     return $statement->execute();
//   }
//   public function deleteItem($id)
//   {
//     $statement = new ArangoStatement(
//       $this->arangoConnection,
//       [
//         'query' => 'FOR u IN item FILTER u._key == @key REMOVE { _key: @key } IN item',
//         'bindVars' => [
//           'key' => $id,
//         ]
//       ]
//     );
//     $statement->execute();
//     return redirect()->back();
//   }
// }
