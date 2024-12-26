<?php
include("functions.php");

$id = $_GET['id'];

$pdo = connect_to_db();

$sql = 'SELECT * FROM todo_table_kadai WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$record = $stmt->fetch(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（編集画面）</title>
</head>

<body>
  <form action="txt_image_update.php" method="POST">
    <!-- <input name="id" value="<?= $record['id'] ?>"> -->
    <input type="hidden" name="id" value="<?= $record['id'] ?>">
    <fieldset>
      <legend>DB連携型todoリスト（編集画面）</legend>
      <a href="txt_image_read.php">一覧画面</a>
      <div>
        <!-- image: <input type="file" name="image" id="imageInput" accept="image/*" required> -->
        image:
        <div>
          <!-- <img id="thumbnail" style="display: none; max-width: 150px; max-height: 150px;" alt="サムネイル"> -->
          <img src='<?= $record['image'] ?>' alt='Image' width='100'>
        </div>
      </div>
      <div>
        title: <input type="text" name="title" value="<?= $record['title'] ?>">
      </div>
      <div>
        todo:  <textarea name="todo" rows="4" cols="30"><?= htmlspecialchars($record['todo'], ENT_QUOTES) ?></textarea>
      </div>
      <div>
        <button>submit</button>
      </div>

    </fieldset>
  </form>

  <script>
    // サムネイルを表示するためのJavaScript
    document.getElementById('imageInput').addEventListener('change', function(event) {
      const file = event.target.files[0];
      const thumbnail = document.getElementById('thumbnail');

      if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();

        // ファイル読み込み完了時の処理
        reader.onload = function(e) {
          thumbnail.src = e.target.result; // サムネイルの画像ソースを設定
          thumbnail.style.display = 'block'; // サムネイルを表示
        };

        reader.readAsDataURL(file); // ファイルを読み込む
      } else {
        thumbnail.style.display = 'none'; // 画像がない場合は非表示
        thumbnail.src = '';
      }
    });
  </script>

</body>

</html>