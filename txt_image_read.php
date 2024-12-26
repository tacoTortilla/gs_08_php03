<?php

// DB接続
include('functions.php');
$pdo = connect_to_db();

// SQL作成&実行
$sql = 'SELECT * FROM todo_table_kadai';
$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// SQL実行の処理

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($result as $record) {

  // $output .= "
  //   <tr>
  //     <td>{$record["updated_at"]}</td>
  //     <td>{$record["title"]}</td>
  //     <td>{$record["todo"]}</td>
  //     <td><img src='{$record["image"]}' alt='Image' width='100'></td>
  //   </tr>
  // ";

//  var_dump($record["todo"]);
//  echo nl2br(htmlspecialchars($record["todo"], ENT_QUOTES, 'UTF-8'));
//  exit();

  $output .= "
    <tr>
      <td><img src='{$record["image"]}' alt='Image' width='100'></td>
      <td>Date:{$record["updated_at"]}<BR>
      Title:{$record["title"]}<BR>
      Todo:{$record["todo"]}</td>
      <td>
        <a href='txt_image_edit.php?id={$record["id"]}'>edit</a><BR>
        <a href='txt_image_delete.php?id={$record["id"]}'>delete</a>
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
  <title>SQL連携型todoリスト（一覧画面）</title>
</head>

<body>
  <fieldset>
    <legend>SQL連携型todoリスト（一覧画面）</legend>
    <a href="txt_image_input.php">入力画面</a>
    <table>
      <thead>
        <tr>
          <!-- <th>update</th>
          <th>title</th>
          <th>todo</th>
          <th>Image</th> -->
          <th>リスト</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>