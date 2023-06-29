<?php require "./includes/_database.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="style.css" rel="stylesheet">
  <title>TaskViktor</title>
</head>

<body>
  <div class="container">
    <h1>TaskViktor</h1>

    <form class="add-todo" action="add.php" method="post">
      <ul class="todo-list">
        <?php
        $query = $dbCo->prepare("SELECT description_task, date_creation, client_id FROM task WHERE status_task = 0 ORDER BY date_creation ASC");
        $query->execute();
        $result = $query->fetchAll();

        foreach ($result as $task) {
          echo '<li class="todo-item"><input type="checkbox" id="task"><label for="task">' . $task['description_task'] . '</label></li>';
        }
        ?>
      </ul>
      <input type="text" id="newTaskInput" name="name" placeholder="Add a new task">
      <button type="submit">Add</button>
    </form>
  </div>
</body>

</html>

