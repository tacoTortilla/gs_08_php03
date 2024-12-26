<?php
include('functions.php');

//debug
// echo "<pre>";
// var_dump($_POST);
// echo "<pre>";
// exit();

// POSTデータ確認
if (
    !isset($_POST['todo']) || $_POST['todo'] === '' ||
    !isset($_POST['title']) || $_POST['title'] === '' ||
    !isset($_POST['id']) || $_POST['id'] === ''
  ) {
    exit('paramError');
  }
  
  $todo = $_POST['todo'];
  $title = $_POST['title'];
  $id = $_POST['id'];

  //  var_dump($title);
  //  exit();

  // ストレージに画像を保存する
// 画像が送信されているか確認
// if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
//   $uploadDir = 'uploads/'; // アップロード先ディレクトリ
//   if (!is_dir($uploadDir)) {
//       mkdir($uploadDir, 0777, true); // ディレクトリを作成
//   }

//   $image = $_FILES['image']['tmp_name'];
//   $fileName = basename($_FILES['image']['name']);
//   $targetFilePath = $uploadDir . $fileName;

//   // var_dump($targetFilePath);
//   // exit();

//   // ファイルを移動
//   if (move_uploaded_file($image, $targetFilePath)) {
//       echo "画像をアップロードしました: " . $targetFilePath;
//   } else {
//       echo "画像のアップロードに失敗しました。";
//   }
// } else {
//   echo "画像が正しく送信されていません。";
// }

// DB接続
$pdo = connect_to_db();



// 必ず WHERE で id を指定すること！！！
$sql = 'UPDATE todo_table_kadai SET todo=:todo, title=:title, updated_at=now() WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':todo', $todo, PDO::PARAM_STR);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header('Location:txt_image_read.php');
exit();