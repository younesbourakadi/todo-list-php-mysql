<?php
require './includes/_database.php';

session_start();

if (
  !array_key_exists('HTTP_REFERER', $_SERVER)
  || !str_contains($_SERVER['HTTP_REFERER'], 'http://localhost/todo-list-php-mysql')
) {
  header('Location: index.php?msg=error_referer');
  exit;
} else if (
  !array_key_exists('token', $_SESSION) || !array_key_exists('token', $_REQUEST)
  || $_SESSION['token'] !== $_REQUEST['token']
) {
  header('Location: index.php?msg=error_csrf');
  exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $taskId = isset($_GET['task_id']) ? $_GET['task_id'] : null;

  if ($taskId) {
    $query = $dbCo->prepare("SELECT task_order FROM task WHERE id_task = :task_id");
    $query->execute([':task_id' => $taskId]);
    $task = $query->fetch(PDO::FETCH_ASSOC);

    if ($task) {
      $taskOrder = $task['task_order'];

      $deleteQuery = $dbCo->prepare("DELETE FROM task WHERE id_task = :task_id");
      $deleteQuery->execute(['task_id' => $taskId]);
      $updateQuery = $dbCo->prepare("UPDATE task SET task_order = task_order - 1 WHERE task_order > :task_order");
      $updateQuery->execute(['task_order' => $taskOrder]);
    }
  }
}

header('Location: index.php');
exit();
