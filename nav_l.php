<link rel="stylesheet" href="CSS/nav_l.css" />

<nav>
  <a href="pg.php"><img src="IMG/logo.png" alt="Logo" id="logo" /></a>

  <ul>
    <li>
      <a id="links" href="produtos.php">Produtos</a>
      <a id="links" href="usuarios.php">Usuarios</a>
      <a id="links" href="vendas.php">Vendas</a>
    </li>
  </ul>
  <div class="container_user">
    <img id="imagem_usuario" src="IMG/login.png" alt="img_usuário">
    <div>
      <p id="nome_usuario"><?php  session_start();
      print_r($_SESSION['login']['nome']); ?></p>

      <p id="cargo_usuario"> <?php print_r($_SESSION['login']['cargo']); ?></p>
    </div>
    <a href="index.php">
      <img src="IMG/sair.png" alt="Sair" width="20px" id="sair" />
    </a>
  </div>
</nav>
