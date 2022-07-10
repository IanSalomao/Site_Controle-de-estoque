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
    <section class="sec-1">
      <div class="container_msg">
        <h1 class="hello_nome" >Hello <?php print_r($_SESSION['login']['nome']); ?></h1>
        <h2>Vamos ao trabalho!</h2>
        <h6><?php print_r($_SESSION['login']['cargo']); ?></h6>
      </div>
    </section>
    <section class="sec-2" >
      <h2>Estatística de vendas por mês(2022)</h2>
     <div id="chartdiv"></div>
    </section>
  <?php include "footer.php" ?>
  </body>
  <?php include "scripts.php" ?>
    <script src="JS/graficos.js"></script>
</html>
