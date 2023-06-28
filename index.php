
<? phpinfo ?>
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

$query = $dbCo->prepare("SELECT * FROM task");
$query->execute();
$result = $query->fetchAll();
var_dump($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="style.css" rel="stylesheet">
  <title>TaskViktor</title>
</head>
<<<<<<< HEAD
  <body>




    <php?

      ?>


    <div class="container">
      <form action="" method="get">
        <label for="">Votre message</label>
        <input type="text" name="note"></input>
<button class="btn-li">GO</button>

      </form>
        </div>
      <ul>
      <li>this is a li</li>
      <button class="btn-li">delete</button> 
=======

<body>
  <div class="container">
    <h1>TaskViktor</h1>
    <form class="add-todo">
      <ul class="todo-list">
        <li class="todo-item">
          <input type="checkbox" id="task1">
          <label for="task1">Aller chez le coiffeur</label>
        </li>
>>>>>>> c5be05f6511c1fac0ab0b172e743aa4558704130
      </ul>
      <input type="text" id="newTaskInput" placeholder="Add a new task">
      <button type="submit">Add</button>
    </form>
  </div>









</body>

</html>
