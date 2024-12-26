<?php

include('functions.php');

// var_dump($_POST);
// exit();

// POSTデータ確認
if (
    !isset($_POST['todo']) || $_POST['todo'] === '' ||
    !isset($_POST['title']) || $_POST['title'] === ''
  ) {
    exit('ParamError');
  }

$todo = $_POST['todo'];
$title = $_POST['title'];

// ストレージに画像を保存する
// 画像が送信されているか確認
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/'; // アップロード先ディレクトリ
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // ディレクトリを作成
    }

    $image = $_FILES['image']['tmp_name'];
    $fileName = basename($_FILES['image']['name']);
    $targetFilePath = $uploadDir . $fileName;

    // var_dump($targetFilePath);
    // exit();

    // ファイルを移動
    if (move_uploaded_file($image, $targetFilePath)) {
        echo "画像をアップロードしました: " . $targetFilePath;
    } else {
        echo "画像のアップロードに失敗しました。";
    }
} else {
    echo "画像が正しく送信されていません。";
}

// DB接続
$pdo = connect_to_db();

//debug
// var_dump($todo);
// var_dump($title);
// var_dump($targetFilePath);
// exit();


// SQL作成&実行
$sql = 'INSERT INTO todo_table_kadai (id, todo, created_at, updated_at,image,title) VALUES (NULL, :todo,  now(), now(),:targetFilePath,:title)';

$stmt = $pdo->prepare($sql);

// バインド変数を設定
// バインド処理をすることにより データベースの攻撃対策
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':todo', $todo, PDO::PARAM_STR);
$stmt->bindValue(':targetFilePath', $targetFilePath, PDO::PARAM_STR);


// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header('Location:txt_image_read.php');
exit();
