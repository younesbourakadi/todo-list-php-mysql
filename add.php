<?php
require 'includes/_database.php';

if (isset($_POST['name'])) {
  $query = $dbCo->prepare("INSERT INTO task (description_task, date_creation, status_task, client_id) VALUES (:name, NOW(), 0, 1)");
  $isOk = $query->execute([
    'name' => strip_tags($_POST['name'])
  ]);
}

header('Location: index.php');
exit();
?>

