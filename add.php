<?php
require 'includes/_database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
  $taskName = strip_tags($_POST['name']);

  // Ajouter la nouvelle tâche à la base de données
  $insertQuery = $dbCo->prepare("INSERT INTO task (description_task, date_creation, status_task, client_id) VALUES (:name, NOW(), 0, 1)");
  $isOk = $insertQuery->execute(['name' => $taskName]);

  if ($isOk) {
    // La tâche a été ajoutée avec succès, donc supprimer la notification
    $deleteQuery = $dbCo->prepare("DELETE FROM notification");
    $deleteQuery->execute();
  }
}

header('Location: index.php');
exit();
?>

