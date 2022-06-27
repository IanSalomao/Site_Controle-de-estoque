<!DOCTYPE html>
<html lang="pt-br">
  <head>
 <?php 
 include "head.php";
 session_start(); 
 ?>
    <link rel="stylesheet" href="CSS/pg.css">
    <title>Organiza_ai</title>
  </head>
  <body>
    <?php include "nav.php";?>

    <div class="container_msg">
        <h1 class="hello_nome" >Hello <?php print_r($_SESSION['login']['nome']); ?></h1>
        <h2>Vamos ao trabalho!</h2>
        <h6><?php print_r($_SESSION['login']['cargo']); ?></h6>

  </body>
  <?php include "scripts.php" ?>
</html>
