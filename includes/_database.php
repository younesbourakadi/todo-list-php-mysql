

<?php 
try {
$dbCo = new PDO(
'mysql:host=localhost;dbname=taskvictor;charset=utf8',
'root',
'root'
);
$dbCo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,
PDO::FETCH_ASSOC);
}
catch (Exception $e) {
die('Unable to connect to the database.
'.$e->getMessage());
}

    $query = $dbCo->prepare("SELECT  description_task, date_creation, client_id FROM task ORDER BY date_creation ASC");
$query->execute();
$result = $query->fetchAll();
var_dump($result);
?>


