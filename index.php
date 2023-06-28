
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="style.css" rel="stylesheet">
  <title>TaskViktor</title>
</head>
  <body>

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

$query = $dbCo->prepare("SELECT  description_task, date_creation, client_id FROM task");
$query->execute();
$result = $query->fetchAll();
var_dump($result);
?>



  <div class="container">
    <h1>TaskViktor</h1>
    <form class="add-todo">
      <ul class="todo-list">
          <?php

          foreach($result as $task){
          echo '<li class=\"todo-item\">'.$task['description_task'].
          '<input type=\"checkbox\" id=\"task1\">';
'</li>';
}
?>
      </ul>
      <input type="text" id="newTaskInput" placeholder="Add a new task">
      <button type="submit">Add</button>
    </form>
  </div>









</body>

</html>
