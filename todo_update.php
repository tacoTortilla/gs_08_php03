<?php
include('functions.php');

// var_dump($_POST);
// exit();

// POSTデータ確認
if (
    !isset($_POST['todo']) || $_POST['todo'] === '' ||
    !isset($_POST['deadline']) || $_POST['deadline'] === '' ||
    !isset($_POST['id']) || $_POST['id'] === ''
  ) {
    exit('paramError');
  }
  
  $todo = $_POST['todo'];
  $deadline = $_POST['deadline'];
  $id = $_POST['id'];


$pdo = connect_to_db();

// 必ず WHERE で id を指定すること！！！
$sql = 'UPDATE todo_table SET todo=:todo, deadline=:deadline, updated_at=now() WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':todo', $todo, PDO::PARAM_STR);
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header('Location:todo_read.php');
exit();