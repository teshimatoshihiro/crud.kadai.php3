<?php
// データ受け取り
$id = $_GET['id'];

include('functions.php');

// DB接続
$pdo = connect_to_db();

// SQL実行
$sql = 'DELETE FROM kadai_card_table WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

//////////////SQL実行処理////////////////////////////
header("Location:kadai3.read.php");
exit();

?>





