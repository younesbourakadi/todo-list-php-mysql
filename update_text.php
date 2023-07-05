<?php
require 'includes/_database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id']) && isset($_POST['new_description'])) {
  $taskId = $_POST['task_id'];
  $newDescription = $_POST['new_description'];

  $updateQuery = $dbCo->prepare("UPDATE task SET description_task = :newDescription WHERE id_task = :taskId");
  $updateQuery->execute(['newDescription' => $newDescription, 'taskId' => intval(strip_tags($taskId))]);

  if ($updateQuery) {
    $message = "Task description has been updated.";
  } else {
    $message = "An error occurred while updating the task description. Please try again.";
  }
} else {
  $message = "Invalid request. Please try again.";
}

$insertNotificationQuery = $dbCo->prepare("INSERT INTO notification (message, created_at) VALUES (:message, NOW())");
$insertNotificationQuery->execute(['message' => $message]);

header('Location: index.php');
exit();
?>














