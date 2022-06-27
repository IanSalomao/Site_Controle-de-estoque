<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <?php include "head.php" ?>
    <link rel="stylesheet" href="CSS/produtos.css">
    <title>Produtos</title>
  </head>
  <body>
    <?php include "nav.php" ?>
    <section class="sec-1">
      <h4>Cadastrar Produto</h4>
      <form id="form_produto">
       <div class="box-1">        
          <input type="text" id="nome" placeholder="Nome do produto" required/>  
          <input type="text" id="fornecedor" placeholder="Fornecedor" required/>  
        </div>
        <div class="box-2">
          <input type="number" id="quantidade" placeholder="Quantidade" required/>
          <input type="text" id="custo" placeholder="Custo" required/>
          <input type="text" id="valor" placeholder="Valor de venda" required/>
          <input type="text" id="codigo" placeholder="Código do produto" required/> 
       </div>
        <input value="Cadastrar" class="btn-form" type="submit" form="form_produto" />
      </form>
    </section>

    <section class="sec-2">
      <div class="container_tabela_produtos">
        <table class="table table-striped" id="mytable">
          <thead>
              <h4>Tabela de Produtos</h4>
              <div class="warning_produtos">
                <img src="IMG/warning.png" alt="warning icone" width="40px">
                <h6>O seu estoque tem menos de 10 produs!</h6>
              </div>
              <tr>
                <th style="text-align:center">ID</th>
                <th style="text-align:center">Nome/U</th>
                <th style="text-align:center">Nome</th>
                <th style="text-align:center">Código</th>
                <th style="text-align:center">Data</th>
                <th style="text-align:center">Quantidade</th>
                <th style="text-align:center">Fornecedor</th>
                <th style="text-align:center">Custo</th>
                <th style="text-align:center">Valor</th>
                <th style="text-align:center"></th>
                <th style="text-align:center"></th>
              </tr>
          </thead>
          <tbody class= "tabela_produtos">
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
          <form id="edit_form_produto">
            <h4>Editar Produto</h4>
            <label>Nome</label>
            <input type="text" id="edit_nome" placeholder="Nome do produto" required/>
            <label>Fornecedor</label>
            <input type="text" id="edit_fornecedor" placeholder="Fornecedor" required/>
            <label>Quantidade</label>
            <input type="number" id="edit_quantidade" placeholder="Quantidade" required/>
            <label>Custo</label>
            <input type="text" id="edit_custo" placeholder="Custo" required/>
            <label>Valor de venda</label>
            <input type="text" id="edit_valor" placeholder="Valor de venda" required/>
            <label>Código do produto</label>
            <input type="text" id="edit_codigo" placeholder="Código do produto" required/>
            <div class="box-1">
              <input value="Salvar alterações" class="edit_btn-form" id="salvar" type="submit" form="edit_form_produto" />
            </div>
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
    getTabela_produto();
    click_editDelet_produto();
  </script>
</html>