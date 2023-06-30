<?php
require './includes/_database.php';
?>


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

    <?php
    // Récupération de la dernière notification
    $notificationQuery = $dbCo->prepare("SELECT message FROM notification ORDER BY created_at ASC LIMIT 1");
    $notificationQuery->execute();
    $notificationResult = $notificationQuery->fetch(PDO::FETCH_ASSOC);
    $notification = isset($notificationResult['message']) ? $notificationResult['message'] : "";

    if (!empty($notification)) {
      echo '<div class="notification">' . $notification . '</div>';
    }

    ?>


    <form class="add-todo" action="add.php" method="post">
      <input type="text" id="newTaskInput" name="name" placeholder="Add a new task">
      <button type="submit" class="add-btn" name="submit">Add</button>
    </form>

    <ul class="todo-list">
      <?php
      $query = $dbCo->prepare("SELECT id_task, description_task, date_creation, client_id FROM task WHERE status_task = 0 ORDER BY date_creation ASC");
      $query->execute();
      $result = $query->fetchAll();

      foreach ($result as $task) {
        echo '<li class="todo-item">
          <span class="task-description">' . $task['description_task'] . '</span>
          <a href="update.php?task_id=' . $task['id_task'] . '" class="complete-btn">Complete</a>
          <form class="update-form" action="update_text.php" method="post">
            <input type="hidden" name="task_id" value="' . $task['id_task'] . '">
            <input type="text" name="new_description" placeholder="New description">
            <button type="submit" class="update-btn">Update</button>
          </form>
        </li>';
      }
      ?>
    </ul>

  </div>
</body>

</html>

