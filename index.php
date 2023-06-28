
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
    <title>Document</title>
</head>
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
      </ul>





  
    
    
    
    
      
    
</body>
</html>
