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
  $description = isset($_POST['description']) ? $_POST['description'] : null;
  $clientId = 1;

  if ($description) {
    $query = $dbCo->prepare("SELECT MAX(task_order) AS max_order FROM task");
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $maxOrder = $result['max_order'];

    $newTaskOrder = $maxOrder + 1;

    $insertQuery = $dbCo->prepare("INSERT INTO task (description_task, date_creation, task_order, client_id) VALUES (:description, NOW(), :task_order, :client_id)");
    $insertQuery->bindParam(':description', $description);
    $insertQuery->bindParam(':task_order', $newTaskOrder);
    $insertQuery->bindParam(':client_id', $clientId);
    $insertQuery->execute();
  }
}

header('Location: index.php');
exit();
