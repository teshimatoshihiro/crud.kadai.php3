<?php

// id受け取り
include("functions.php");

$id = $_GET['id'];

//$pdoは、PDO（PHP Data Objects）クラスのインスタンスです。PDOは、異なるデータベースに対して一貫した方法でアクセスするためのPHPの拡張機能です
$pdo = connect_to_db();

//SELECT 文を用いて id 指定し
$sql = 'SELECT * FROM kadai_card_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
// バインド変数を設定//////////////////////////////////////////
// ハッキング防止のため、ユーザー入力値をSQL内で使用する際にはbind変数を使用する
////////////////////////////////////////////////////////////////

$stmt->bindValue(':id', $id, PDO::PARAM_INT);


try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}


//fetch() 関数でデータを取得する
$record = $stmt->fetch(PDO::FETCH_ASSOC);


// DB接続


// SQL実行


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（編集画面）</title>
</head>

<body>
  <form action="kadai3.update.php" method="POST">
  <fieldset>
    <legend>DB連携型todoリスト（編集画面）</legend>
    <a href="kadai3.read.php">一覧画面</a>
    <div>
      name: <input type="text" name="name" value="<?= $record['name'] ?>">
    </div>
    <div>
      occupation: <input type="text" name="occupation" value="<?= $record['occupation'] ?>">
    </div>
    <div>
      department: <input type="text" name="department" value="<?= $record['department'] ?>">
    </div>
    <div>
      regidential: <input type="text" name="regidential" value="<?= $record['regidential'] ?>">
    </div>
    <div>
      email: <input type="text" name="email" value="<?= $record['email'] ?>">
    </div>
    <div>
      deadline: <input type="date" name="deadline" value="<?= $record['deadline'] ?>">
    </div>

<!-- 次の更新処理で id が必要になるため，<input type="hidden"> を用いて id を送信する． -->
    <div>
      <input type="hidden" name="id" value="<?= $record['id'] ?>">
    </div>
    <div>
      <button>submit</button>
    </div>
  </fieldset>
</form>

</body>

</html>