<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <?php include "head.php" ?>
    <link rel="stylesheet" href="CSS/vendas.css">
    <title>Vendas</title>
  </head>
  <body>
    <?php include "nav.php" ?>
    <section class="sec-1">
      <h4>Adicionar venda</h4>
      <form id="form_venda">       
        <input type="text" id="codigo_p" placeholder="Código do produto" required/>  
        <input type="number" id="quantidade" placeholder="Quantidade" required/>
        <input type="text" id="valor" placeholder="Valor da venda" required/>
        <input value="Cadastrar" class="btn-form" type="submit" form="form_venda" />
      </form>
    </section>

    <section class="sec-2">
      <div class="container_tabela_vendas">
        <table class="table table-striped" id="mytable">
          <thead>
              <h4>Tabela de vendas</h4>
              <tr>
                <th>ID</th> <!--lembrar de alinhar ao centro -->
                <th>Código/p</th>
                <th>Nome/u</th>
                <th>Data</th>
                <th>Quantidade</th>
                <th>valor</th>
                <th></th>
                <th></th>
              </tr>
          </thead>
          <tbody class= "tabela_vendas">
          </tbody>
        </table>
      </div>
    </section>
    <!-- - - - - modais - - - - -->
    <div class="bg_modal">
      <div class="modal_delet">
        <h3>Tem certeza que dezeja excluir essa venda?</h3>
        <div>
          <button id="deletar" class="btn">Deletar</button>
          <button id="cancelar" class="btn">Cancelar</button>
        </div>
      </div>
        <div class="modal_editar">
          <form id="edit_form_venda">
            <h4>Editar Produto</h4>
            <label>Código do produto</label>
            <input type="text" id="edit_codigo_p" placeholder="Código do produto" required/>  
            <label>Quantidade</label>
            <input type="number" id="edit_quantidade" placeholder="Quantidade" required/>
            <label>Valor da venda</label>
            <input type="text" id="edit_valor" placeholder="Valor da venda" required/>
        
            <input value="Salvar" id="salvar" class="btn-form" type="submit" form="edit_form_venda" />
          </form>
          <div class="container_btn_cancelar">
            <button id="cancelar" >Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </body>
  <?php include "scripts.php" ?>
  <script>
    getTabela_venda();
    click_editDelet_venda();
  </script>
</html>