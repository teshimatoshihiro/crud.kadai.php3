<?php
//DB接続///
include('functions.php');
$pdo = connect_to_db();

// SQL作成&実行//////////////////////////////////////////
//全てのカラムを参照/////////////////////////////////////
$sql = 'SELECT * FROM kadai_card_table ORDER BY deadline ASC';
$stmt = $pdo->prepare($sql);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// SQL実行の処理///////////////////////////////////////////
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($result as $record) {
  $output .= "
    <tr>
      <td>{$record["name"]}</td>
      <td>{$record["occupation"]}</td>
      <td>{$record["department"]}</td>
      <td>{$record["regidential"]}</td>
      <td>{$record["email"]}</td>
      <td>{$record["deadline"]}</td>
  
  <td>
  <a href='kadai3.edit.php?id={$record["id"]}'>edit</a>
  </td>
      <td>
        <a href='kadai3.delete.php?id={$record["id"]}'>delete</a>
        </td>
    </tr>
  ";
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（一覧画面）</title>
</head>

<body>
  <fieldset>
    <legend>DB連携型todoリスト（一覧画面）</legend>
    <a href="kadai3.input.php">入力画面</a>
    <table>
      <thead>
        <tr>
          <th>name</th>
          <th>occupation</th>
          <th>department</th>
          <th>regidential</th>
          <th>email</th>
          <th>deadline</th>
        </tr>
      </thead>
      <tbody>
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>