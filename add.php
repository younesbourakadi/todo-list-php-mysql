<?php
require 'includes/_database.php';
$query = $dbCo->prepare("INSERT INTO task (description_task, date_creation, status_task, client_id) VALUES (:name, NOW(), 0, 1)");
$isOk = $query->execute([
  'name' => strip_tags($_POST['name'])
]);
header('location: index.php');
exit();
