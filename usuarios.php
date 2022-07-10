<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <?php include "head.php" ?>
    <link rel="stylesheet" href="CSS/usuarios.css">
    <title>Usuários</title>
  </head>
  <body>
    <?php include "nav.php" ?>
    <section class="sec-1">
      <h4>Cadastrar usuário</h4>
      <form id="form_cadastro">
       <div class="box-1">        
          <input type="text" id="nome" placeholder="Nome" required/>  
          <input type="email" id="email" placeholder="Email" required/> 
        </div>
        <div class="box-2">
          <input type="text" id="cpf" placeholder="CPF" maxlength="14" onkeyup="mascara_cpf(this)" required/>
          <input type="password" id="senha" placeholder="Senha" required/>       
          <select id="cargo" required>
            <option>Administrador</option>
            <option>Vendedor</option>
          </select>
       </div>
        <input value="Cadastrar" class="btn-form" type="submit" form="form_cadastro" />
      </form>
    </section>
    <section class="sec-2">
      <div class="container_tabela_usuarios">
        <table class="table table-striped" id="mytable">
          <thead>
            <h4>Tabela de usuários</h4>
              <div class="contador">
              </div>
              <tr>
                <th style="text-align:center">ID</th>
                <th style="text-align:center">Nome</th>
                <th style="text-align:center">Email</th>
                <th style="text-align:center">CPF</th>
                <th style="text-align:center">Senha</th>
                <th style="text-align:center">Cargo</th>
                <th style="text-align:center"></th>
                <th style="text-align:center"></th>
              </tr>
          </thead>
          <tbody class="tabela_usuarios">
          </tbody>
        </table>
      </div>
    </section>
    <!-- - - - - modais - - - - -->
    <div class="bg_modal">
      <div class="modal_delet">
        <h3>Tem certeza que dezeja excluir esse produto?</h3>
        <div>
          <button id="deletar" class="btn">Deletar</button>
          <button id="cancelar" class="btn">Cancelar</button>
        </div>
      </div>
      <div class="modal_editar">
        <form id="edit_form_usuario">
          <h4>Editar usuário</h4>
            <label>Nome do usuário</label>
            <input type="text" id="edit_nome" placeholder="Nome" required/>  
            <label>Email</label>
            <input type="email" id="edit_email" placeholder="Email" required/>
            <label>cpf</label>
            <input type="text" id="edit_cpf" placeholder="CPF" maxlength="14" onkeyup="mascara_cpf(this)" required/>
            <label>Senha</label>
            <input type="pasowrd" id="edit_senha" placeholder="Senha" required/>
            <label>Cargo</label>
            <select id="edit_cargo" required>
              <option>Administrador</option>
              <option>Vendedor</option>
            </select>
        <div class="box-1">
          <input value="Salvar alterações" class="edit_btn-form" id="salvar" type="submit" form="edit_form_usuario" />
        </div>
        </form>
        <div class="container_btn_cancelar">
            <button id="cancelar" >Cancelar</button>
          </div>
      </div>
    </div>
      <?php include "footer.php" ?>
  </body>
  <?php include "scripts.php" ?>
  <script>
  getTabela_usuario();
  click_editDelet_usuario();
  </script>
</html>

