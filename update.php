<?php
require 'includes/_database.php';

if (isset($_GET['task_id'])) {
  $taskId = $_GET['task_id'];

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

$insertNotificationQuery = $dbCo->prepare("INSERT INTO notification (message, created_at) VALUES (:message, NOW())");
$insertNotificationQuery->execute(['message' => $message]);

header('Location: index.php');
exit();
?>

