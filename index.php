<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="CSS/login.css" />
    <title>Login</title>
  </head>
  <body>
    <form id="form_login">
      <h2>Login</h2>
      <label for="">Email</label>
      <input type="email" id="email" required />
      <label for="">Senha</label>
      <input type="password" id="senha" required />
      <input type="submit" form="form_login" />
      <div class="msg_erro_login"><h4>Usuário ou senha incorreto.</h4></div>
    </form>
  </body>
<?php include "scripts.php" ?>
</html>