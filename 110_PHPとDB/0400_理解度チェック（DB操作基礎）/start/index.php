<?php
/**
 * 理解度チェック（DB操作基礎）
 */

// $user = 'test_user';
// $pwd = 'pwd';
// $host = 'localhost';
// $dbName = 'test_phpdb';
// $dsn = "mysql:host={$host};port=8889;dbname={$dbName};";
// $conn = new PDO($dsn, $user, $pwd);
// $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$user = 'test_user';
$pwd = 'pwd';
$host = 'localhost';
$dbName = 'test_phpdb';
$dsn = "mysql:host={$host};port=8889;dbname={$dbName};";
$conn = new PDO($dsn, $user, $pwd);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 以下の操作を行ってみてください。
// またtry, catchによってコードを囲んでください。

/**
 * 問１：
 * 店舗Cの全ての商品の在庫数に+10を足し合わせる
 */

//  try {
//   $conn->exec('
//   update txn_stocks 
//   set amount = amount - 30
//   where shop_id = 3
//   ');
//  } catch(PDOException $e) {
//   echo $e->getMessage();
//  }

/**
 * 問２：
 * 店舗Dを以下のように追加してください。
 */
/**
 * name: '店舗D'
 * pref_id: 4
 */

// try {
//   $conn->exec('
//   insert into mst_shops 
// values
// (4,"店舗D", 4, 0,now() , "takeshi-g");
//   ');
// }catch(PDOException $e) {
//   echo 'Error : '.$e->getMessage();
// }


//  try{
//     $conn->exec('
//     insert into mst_shops (name, pref_id, updated_by)
//     values("店舗D", 4, "takeshi-g")
//     ');
//  }catch(Error $e) {
//     echo $e->getMessage();
//  }finally {
//     // echo 'finally';
//     echo "shop result : $result";
//  }
/**
 * 問３：
 * 店舗Aの椅子の在庫数を取得してください。
 */

try {
  $result = $conn->query('select ts.amount from txn_stocks ts
  join mst_products  mp 
  on mp .id = ts.product_id 
  join mst_shops ms 
  on ms.id = ts .shop_id 
  where ms.name = "店舗A"and mp.name= "椅子"
  ;') ->fetch()['amount'];
  echo $result;

}catch (PDOException $e) {
  echo $e->getMessage();
}


// try {
//     $result = $conn->query('select amount from txn_stocks where shop_id = 1 and product_id = 2' );
// } catch(PDOException $e) {
//   echo $e->getMessage();
// } finally {
//     echo "products : $result";
// }

