<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="../img/favicon/BusinessSolution16x16.ico">
  <link rel="stylesheet" href="../lib/icon/sharp.css">
  <link rel="stylesheet" href="../css/app.css">
  <?php 
    if (isset($css)) {
      foreach ($css as $value) {
        echo "<link rel='stylesheet' href='{$value}'>";
      }
    }
  ?>  
  <title>BUSINESS SOLUTION</title>
</head>
<body>
    <!-- <aside>
      <?= $navbarMenu; ?>
    </aside> -->
    <section>
      <?= $content; ?>
    </section>
</body>
<?php 
  if (isset($js)) {
    foreach ($js as $value) {
      echo "<script src='{$value}'></script>";
    }
  }
?>
</html>