<?php
require './includes/_database.php';

session_start();
$_SESSION['token'] = md5(uniqid(mt_rand(), true));

?>
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

    <?php

    $notificationQuery = $dbCo->prepare("SELECT message FROM notification ORDER BY created_at ASC LIMIT 1");
    $notificationQuery->execute();
    $notificationResult = $notificationQuery->fetch(PDO::FETCH_ASSOC);
    $notification = isset($notificationResult['message']) ? $notificationResult['message'] : "";

    if (!empty($notification)) {
      echo '<div class="notification">' . $notification . '</div>';
    }
    ?>
    <form class="add-todo" action="add.php" method="post">
      <input type="text" id="newTaskInput" name="description" placeholder="Add a new task">
      <button type="submit" class="add-btn" name="submit">Add</button>
    </form>

    <ul class="todo-list">
      <?php
      $query = $dbCo->prepare("SELECT id_task, description_task, date_creation, task_order, client_id FROM task WHERE status_task = 0 ORDER BY task_order ASC, date_creation ASC");
      $query->execute();
      $result = $query->fetchAll();

      foreach ($result as $task) {
        echo '<li class="todo-item">
          <span class="task-description">' . $task['description_task'] . '</span>

          <a href="update.php?task_id=' . $task['id_task'] . '" class="complete-btn">Complete</a>

          <a href="delete.php?task_id=' . $task['id_task'] . "&token=" . $_SESSION['token'] . '" class="delete-btn">DELETE</a>
      

          <form class="update-form" action="update_text.php" method="post">
            <input type="hidden" name="task_id" value="' . $task['id_task'] . '">
            <button type="submit" class="update-btn">Update</button>
            <input type="text" name="new_description" placeholder="New description">
          </form>
          <form class="move-form" action="move.php" method="post">
            <input type="hidden" name="task_id" value="' . $task['id_task'] . '">
            <input type="hidden" name="move" value="up">
            <button type="submit" class="move-btn">&#8593;</button>
          </form>
          <form class="move-form" action="move.php" method="post">
            <input type="hidden" name="task_id" value="' . $task['id_task'] . '">
            <input type="hidden" name="move" value="down">
            <button type="submit" class="move-btn">&#8595;</button>
          </form>

        </li>';
      }






      ?>
    </ul>
  </div>
  <script src="./script.js"></script>
</body>

</html>