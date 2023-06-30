<?php
require 'includes/_database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id'])) {
  $taskId = $_POST['task_id'];

  $updateQuery = $dbCo->prepare("UPDATE task SET status_task = 1 WHERE id_task = :taskId");
  $updateQuery->execute(['taskId' => intval(strip_tags($taskId))]);

  if ($updateQuery) {
    $message = "Task has been marked as completed.";
  } else {
    $message = "An error occurred while updating the task. Please try again.";
  }
} else {
  $message = "Invalid request. Please try again.";
}

header('Location: index.php?message=' . urlencode($message));
exit();
?>

