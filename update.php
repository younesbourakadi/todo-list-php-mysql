<?php
require 'includes/_database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id'])) {
  $taskId = $_POST['task_id'];

  $updateQuery = $dbCo->prepare("UPDATE task SET status_task = 1 WHERE id_task = :taskId");
  $updateQuery->execute(['taskId' => $taskId]);
}

header('Location: index.php');
exit();
?>

