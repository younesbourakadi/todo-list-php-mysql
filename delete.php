<?php
require './includes/_database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $taskId = isset($_GET['task_id']) ? $_GET['task_id'] : null;

  if ($taskId) {
    $query = $dbCo->prepare("SELECT task_order FROM task WHERE id_task = :task_id");
    $query->execute([':task_id' => $taskId]);
    $task = $query->fetch(PDO::FETCH_ASSOC);

    if ($task) {
      $taskOrder = $task['task_order'];

      $deleteQuery = $dbCo->prepare("DELETE FROM task WHERE id_task = :task_id");
      $deleteQuery->execute([':task_id' => $taskId]);

      $updateQuery = $dbCo->prepare("UPDATE task SET task_order = task_order - 1 WHERE task_order > :task_order");
      $updateQuery->execute([':task_order' => $taskOrder]);
    }
  }
}

header('Location: index.php');
exit();
