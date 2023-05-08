<form action="<?php $_SERVER['REQUEST_URI']; ?>" method="POST">
Shop ID: <input type="text" name="shop_id">
    <input type="submit" value="検索">
</form>

<?php
/**
 * DB操作クラスを作成（続き）
 * 
 * 例）店舗Aから店舗Cへ商品を転送する場合のトランザクション
 */

 require_once('./datasource.php');

 use db\DataSource;
 
try {
    $db = new DataSource;
    // $user = 'test_user';
    // $pwd = 'pwd';
    // $host = 'localhost';
    // $dbName = 'test_phpdb';
    // $dsn = "mysql:host={$host};port=8889;dbname={$dbName};";
    // $conn = new PDO($dsn, $user, $pwd);
    // $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $product_id = 2;
    $from_shop_id = 1;
    $to_shop_id = 3;
    $amount = 1;

    $sql = '
        update txn_stocks
        set amount = amount + :amount
        where shop_id = :shop_id
        and product_id = :product_id
    ';
    $db->begin();

    // $conn->beginTransaction();

    $db->execute($sql,[
        ':amount' => $amount,
        ':shop_id' => $to_shop_id,
        ':product_id' => $product_id
    ]);

    $db->execute($sql,[
        ':amount' => -1 * $amount,
        ':shop_id' => $from_shop_id,
        ':product_id' => $product_id
    ]);

    $db->commit();

} catch (PDOException $e) {

    echo 'エラーが発生しました。<br>';
    echo $e->getMessage();
    $db->rollBack();
}

if (isset($_POST['shop_id'])) {
    try {

        $shop_id = $_POST['shop_id'];

        $db = new DataSource();

        $result = $db->selectOne("select * from test_phpdb.mst_shops where id = :id", [
            ':id' => $shop_id
        ]);

        if(!empty($result) && count($result) > 0) {
            echo "店舗名 : {$result['name']}";
        } else {
            echo "IDに対応した店舗が見つかりません。";
        }
    } catch(PDOException $e) {
        echo 'エラーが発生しました。';
        echo $e->getMessage();
    }
}