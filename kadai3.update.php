<?php
include('functions.php');
// 入力項目のチェック

// ****************************************************
// 格納するデータが送信されていない、また空の時に警告を出す
// *************************************************

if (
  !isset($_POST['name'])        || $_POST['name']        === '' ||
  !isset($_POST['occupation'])  || $_POST['occupation']  === '' ||
  !isset($_POST['department'])  || $_POST['department']  === '' ||
  !isset($_POST['regidential']) || $_POST['regidential'] === '' ||
  !isset($_POST['email'])       || $_POST['email']       === '' ||
  !isset($_POST['deadline'])    || $_POST['deadline']    === '' 
) {
  exit('paramError');
}
// *****************************************
// データの受け取り
// 変数宣言
// ********************************************
$id          = $_POST['id'];
$name        = $_POST['name'];
$occupation  = $_POST['occupation'];
$department  = $_POST['department'];
$regidential = $_POST['regidential'];
$email       = $_POST['email'];
$deadline    = $_POST['deadline'];



// DB接続
$pdo = connect_to_db();

// SQL作成&実行////////////////////////////////////
//$sql変数のテーブル、カラム名、値をupdate
// 必ず WHERE で id を指定すること！！！
//////////////////////////////////////////////////////

// $sql = 'UPDATE kadai_card_table SET name=:name, occupation=:occupation,department=:department,regidential=:regidential,email=:email,deadline=:deadline, created_at=:created_at,updated_at=now() WHERE id=:id';
///////////////////////////////////////////////////
/////////////////改修版/////////////////////////
$sql = 'UPDATE kadai_card_table SET name=:name, occupation=:occupation,department=:department,regidential=:regidential,email=:email,deadline=:deadline=updated_at=now() WHERE id=:id';


$stmt = $pdo->prepare($sql);

// バインド変数を設定//////////////////////////////////////////
// ハッキング防止のため、ユーザー入力値をSQL内で使用する際にはbind変数を使用する
////////////////////////////////////////////////////////////////
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$stmt->bindValue(':name'     , $name, PDO::PARAM_STR);
$stmt->bindValue(':deadline' , $deadline, PDO::PARAM_STR);
$stmt->bindValue(':occupation', $occupation, PDO::PARAM_STR);
$stmt->bindValue(':department', $department, PDO::PARAM_STR);
$stmt->bindValue(':regidential', $regidential, PDO::PARAM_STR);
$stmt->bindValue(':email'      , $email, PDO::PARAM_STR);


// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

//////////////SQL実行処理////////////////////////////
header('Location: kadai3.read.php');
exit();




