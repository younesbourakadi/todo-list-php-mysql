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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $taskId = isset($_POST['task_id']) ? $_POST['task_id'] : null;
  $action = isset($_POST['move']) ? $_POST['move'] : null;

  if ($taskId && $action) {
    $query = $dbCo->prepare("SELECT MAX(task_order) AS max_order FROM task");
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $maxOrder = $result['max_order'];

    $query = $dbCo->prepare("SELECT id_task, task_order FROM task WHERE id_task = :task_id");
    $query->bindParam(':task_id', $taskId);
    $query->execute();
    $task = $query->fetch(PDO::FETCH_ASSOC);

    if ($task) {
      $currentTaskId = $task['id_task'];
      $currentTaskOrder = $task['task_order'];

      if ($action === 'up') {
        if ($currentTaskOrder > 1) {
          $previousTaskOrder = $currentTaskOrder - 1;

          $query = $dbCo->prepare("UPDATE task SET task_order = :previous_order WHERE task_order = :current_order - 1");
          $query->bindParam(':previous_order', $currentTaskOrder);
          $query->bindParam(':current_order', $currentTaskOrder);
          $query->execute();

          $query = $dbCo->prepare("UPDATE task SET task_order = :current_order WHERE id_task = :current_task_id");
          $query->bindParam(':current_order', $previousTaskOrder);
          $query->bindParam(':current_task_id', $currentTaskId);
          $query->execute();
        }
      } elseif ($action === 'down') {
        if ($currentTaskOrder < $maxOrder) {
          $nextTaskOrder = $currentTaskOrder + 1;

          $query = $dbCo->prepare("UPDATE task SET task_order = :next_order WHERE task_order = :current_order + 1");
          $query->bindParam(':next_order', $currentTaskOrder);
          $query->bindParam(':current_order', $currentTaskOrder);
          $query->execute();

          $query = $dbCo->prepare("UPDATE task SET task_order = :current_order WHERE id_task = :current_task_id");
          $query->bindParam(':current_order', $nextTaskOrder);
          $query->bindParam(':current_task_id', $currentTaskId);
          $query->execute();
        }
      }
    }
  }
}

header('Location: index.php');
exit();
