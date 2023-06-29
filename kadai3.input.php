<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>エコーメンバー登録画面（入力画面）</title>
</head>

<body>
  <form action="kadai3.create.php" method="POST">
    <fieldset>
      <legend>エコーメンバー登録画面（入力画面）</legend>
      <a href="kadai3.read.php">登録一覧画面</a>
      <div>
        名前: <input type="text" name="name">
      </div>
      <div>
        職種（医師/検査技師/その他）: <input type="text" name="occupation">
      </div>
      <div>
        専門（心臓/腹部/血管/体表/なんでも）: <input type="text" name="department">
      </div>
      <div>
        居住地域（北海道/東北/北陸/中部/関東/関西/中国/四国/九州）: <input type="text" name="regidential">
      </div>
      <div>
        email: <input type="text" name="email">
      </div>
      <div>
        deadline: <input type="date" name="deadline">
      </div>
      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>

</body>

</html>