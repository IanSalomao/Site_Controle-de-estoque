// - - - - - - - - - FUNÇÕES PADRÃO - - - - - - - - - - -

//Deleta row
function delet_row(index, tabela) {
  $.ajax({
    url: ".//F_PHP/deletar_row.php",
    method: "POST",
    data: {
      index: index,
      tabela: tabela,
    },
    dataType: "json",
  }).done(function (resultado) {
    console.log(resultado);
    if (tabela == "produtos") {
      getTabela_produto();
    } else if (tabela == "usuarios") {
      getTabela_usuario();
    } else if (tabela == "vendas") {
      getTabela_venda();
    } else {
      console.log("Tabela inválida");
    }
  });
}

// Máscara numérica
function mascara_num(numero) {
  $(numero).val(parseFloat($(numero).val()).toFixed(2));
}

function checagem_de_acesso() {
  $.ajax({
    url: ".//F_PHP/checagem_de_acesso.php",
    method: "GET",
    dataType: "json",
  }).done(function (resultado) {
    if (resultado == "Vendedor") {
      $("ul > #usuarios").remove();
    }
  });
}

checagem_de_acesso();

// Contador de linhas
function contador(resultado) {
  var container = $(".contador");
  $(".contador>h6").remove();
  if (resultado == "False") {
    container.prepend("<h6>Esta tabela está vazia</h6>");
  } else {
    container.prepend("<h6>Linhas:" + resultado.length + "</h6>");
  }
}

// - - - - - - - - - LOGIN - - - - - - - - - - -
$("#form_login").submit(function (e) {
  e.preventDefault();
  var email = $("#email").val();
  var senha = $("#senha").val();

  $.ajax({
    url: ".//F_PHP/login.php",
    method: "POST",
    data: { email: email, senha: senha },
    dataType: "json",
  }).done(function (resultado) {
    if (resultado != "") {
      window.location.assign(".//pg.php");
    } else {
      document.querySelector(".msg_erro_login").style.display = "block";
    }
  });
});

// - - - - - - - - - - - - - - - - - - PRODUTO  - - - - - - - - - - - - - - - - - - - -

// Envia formulário de produto pro banco
$("#form_produto").submit(function (e) {
  e.preventDefault();
  var nome = $("#nome").val();
  var fornecedor = $("#fornecedor").val();
  var quantidade = $("#quantidade").val();
  var custo = $("#custo").val().replace(",", ".");
  var valor = $("#valor").val().replace(",", ".");
  var codigo = $("#codigo").val();

  $.ajax({
    url: ".//F_PHP/inserir_produto.php",
    method: "POST",
    data: {
      nome: nome,
      fornecedor: fornecedor,
      quantidade: quantidade,
      custo: custo,
      valor: valor,
      codigo: codigo,
    },
    dataType: "json",
  }).done(function (resultado) {
    console.log(resultado);
    $("#nome").val("");
    $("#fornecedor").val("");
    $("#quantidade").val("");
    $("#custo").val("");
    $("#valor").val("");
    $("#codigo").val("");
    getTabela_produto();
  });
});

//GET tabela de produtos
function getTabela_produto() {
  $.ajax({
    url: ".//F_PHP/get_tabela.php",
    method: "POST",
    data: {
      tabela: "produtos",
    },
    dataType: "json",
  }).done(function (resultado) {
    contador(resultado);
    if (resultado == "False") {
    } else {
      var tabela_produtos = document.querySelector(".tabela_produtos");
      var warning_produto = document.querySelector(".warning_produtos");

      if (resultado.length < 10) {
        warning_produto.style.display = "inline-flex";
      } else {
        warning_produto.style.display = "none";
      }

      while (tabela_produtos.firstChild) {
        tabela_produtos.firstChild.remove();
      }
      for (var i = 0; i < resultado.length; i++) {
        $(tabela_produtos).prepend(
          "<tr><td ><p>" +
            resultado[i].id +
            "</p></td>" +
            "<td><p>" +
            resultado[i].nome_u +
            "</p></td>" +
            "<td><p>" +
            resultado[i].nome +
            "</p></td>" +
            "<td><p>" +
            resultado[i].codigo +
            "</p></td>" +
            "<td><p>" +
            resultado[i].data +
            "</p></td>" +
            "<td><p>" +
            resultado[i].quantidade +
            "</p></td>" +
            "<td><p>" +
            resultado[i].fornecedor +
            "</p></td>" +
            "<td><p>" +
            resultado[i].custo +
            "</p></td>" +
            "<td><p>" +
            resultado[i].valor +
            "</p></td>" +
            "<td><button class='btn_deletar' type='button' id='deletar-" +
            resultado[i].id +
            "' >Deletar</button></td>" +
            "<td><button class='btn_editar' type='button' id='editar-" +
            resultado[i].id +
            "' >Editar</button></td>"
        );
      }
    }
  });
}

//GET objeto produto
function get_produto(index) {
  $.ajax({
    url: ".//F_PHP/get_row.php",
    method: "POST",
    data: {
      index: index,
      tabela: "produtos",
    },
    dataType: "json",
  }).done(function (resultado) {
    console.log(resultado);
    $("#edit_nome").val(resultado[0].nome);
    $("#edit_fornecedor").val(resultado[0].fornecedor);
    $("#edit_quantidade").val(resultado[0].quantidade);
    $("#edit_custo").val(resultado[0].custo);
    $("#edit_valor").val(resultado[0].valor);
    $("#edit_codigo").val(resultado[0].codigo);
  });
}

//Executas as funções de editar e deletar produto
const editDelet_produto = (event) => {
  if (event.target.type == "button") {
    var evento = ([acao, index] = event.target.id.split("-"));

    // Deleta produto
    if (acao == "deletar") {
      const modal = document.querySelector(".bg_modal");
      const modal_delet = document.querySelector(".modal_delet");
      const btn_deletar = document.querySelector(
        ".modal_delet >  div > #deletar"
      );
      const btn_cancelar = document.querySelector(
        ".modal_delet > div > #cancelar"
      );

      modal.style.display = "flex";
      modal_delet.style.display = "flex";

      btn_cancelar.addEventListener("click", () => {
        modal.style.display = "none";
        modal_delet.style.display = "none";
      });

      btn_deletar.addEventListener("click", () => {
        delet_row(index, "produtos");
        modal.style.display = "none";
        modal_delet.style.display = "none";
      });
    }
    //Edita produto
    else {
      const modal = document.querySelector(".bg_modal");
      const modal_editar = document.querySelector(".modal_editar");

      const btn_salvar = document.querySelector(
        "#edit_form_produto > .box-1 > #salvar"
      );
      const btn_cancelar = document.querySelector(
        ".modal_editar > .container_btn_cancelar > #cancelar"
      );
      modal.style.display = "flex";
      modal_editar.style.display = "flex";

      get_produto(index);

      btn_cancelar.addEventListener("click", () => {
        modal.style.display = "none";
        modal_editar.style.display = "none";
      });

      btn_salvar.addEventListener("click", () => {
        $("#edit_form_produto").submit(function (e) {
          e.preventDefault();
          var nome = $("#edit_nome").val();
          var fornecedor = $("#edit_fornecedor").val();
          var quantidade = $("#edit_quantidade").val();
          var custo = $("#edit_custo").val();
          var valor = $("#edit_valor").val();
          var codigo = $("#edit_codigo").val();

          $.ajax({
            url: ".//F_PHP/editar_produto.php",
            method: "POST",
            data: {
              index: index,
              nome: nome,
              fornecedor: fornecedor,
              quantidade: quantidade,
              custo: custo,
              valor: valor,
              codigo: codigo,
            },
            dataType: "json",
          }).done(function (resultado) {
            console.log(resultado);
            getTabela_produto();
          });
        });
        modal.style.display = "none";
        modal_editar.style.display = "none";
      });
    }
    evento.length = 0;
  }
};

function click_editDelet_produto() {
  document
    .querySelector(".container_tabela_produtos > #mytable > tbody")
    .addEventListener("click", editDelet_produto);
}
// - - - - - - - - - - - - - - - - - - USUÁRIO - - - - - - - - - - - - - - - - - - - -

// - - - Formulário de usuário

//Validar cpf
function _cpf(cpf) {
  cpf = cpf.replace(/[^\d]+/g, "");
  if (cpf == "") return false;
  // Elimina CPFs invalidos conhecidos
  if (
    cpf.length != 11 ||
    cpf == "00000000000" ||
    cpf == "11111111111" ||
    cpf == "22222222222" ||
    cpf == "33333333333" ||
    cpf == "44444444444" ||
    cpf == "55555555555" ||
    cpf == "66666666666" ||
    cpf == "77777777777" ||
    cpf == "88888888888" ||
    cpf == "99999999999"
  )
    return false;
  // Valida 1o digito
  add = 0;
  for (i = 0; i < 9; i++) add += parseInt(cpf.charAt(i)) * (10 - i);
  rev = 11 - (add % 11);
  if (rev == 10 || rev == 11) rev = 0;
  if (rev != parseInt(cpf.charAt(9))) return false;
  // Valida 2o digito
  add = 0;
  for (i = 0; i < 10; i++) add += parseInt(cpf.charAt(i)) * (11 - i);
  rev = 11 - (add % 11);
  if (rev == 10 || rev == 11) rev = 0;
  if (rev != parseInt(cpf.charAt(10))) return false;
  return true;
}

function validarCPF(el) {
  if (!_cpf(el.value)) {
    alert("CPF Inválido! " + el.value);
    el.value = "";
  }
}

function mascara_cpf(cpf) {
  if (cpf.value.length == 3 || cpf.value.length == 7) {
    cpf.value += ".";
  }

  if (cpf.value.length == 11) {
    cpf.value += "-";
  }
}

//Envia formulário de usuário pro banco
$("#form_cadastro").submit(function (e) {
  e.preventDefault();

  var nome = $("#nome").val();
  var cpf = $("#cpf").val();
  var email = $("#email").val();
  var senha = $("#senha").val();
  var cargo = $("#cargo").val();

  $.ajax({
    url: ".//F_PHP/inserir_usuario.php",
    method: "POST",
    data: {
      nome: nome,
      cpf: cpf,
      email: email,
      senha: senha,
      cargo: cargo,
    },
    dataType: "json",
  }).done(function (resultado) {
    getTabela_usuario();
    $("#nome").val("");
    $("#cpf").val("");
    $("#email").val("");
    $("#senha").val("");
    $("#cargo").val("");
    console.log(resultado);
  });
});

//GET tabela de usuários
function getTabela_usuario() {
  $.ajax({
    url: ".//F_PHP/get_tabela.php",
    method: "POST",
    data: {
      tabela: "usuarios",
    },
    dataType: "json",
  }).done(function (resultado) {
    contador(resultado);
    if (resultado == "False") {
    } else {
      var tabela_usuarios = document.querySelector(".tabela_usuarios");
      while (tabela_usuarios.firstChild) {
        tabela_usuarios.firstChild.remove();
      }
      for (var i = 0; i < resultado.length; i++) {
        $(tabela_usuarios).prepend(
          "<tr><td><p>" +
            resultado[i].id +
            "</p></td>" +
            "<td><p>" +
            resultado[i].nome +
            "</p></td>" +
            "<td><p>" +
            resultado[i].email +
            "</p></td>" +
            "<td><p>" +
            resultado[i].cpf +
            "</p></td>" +
            "<td><p>" +
            resultado[i].senha +
            "</p></td>" +
            "<td><p>" +
            resultado[i].cargo +
            "</p></td>" +
            "<td><button class='btn_deletar' type='button' id='deletar-" +
            resultado[i].id +
            "' >Deletar</button></td>" +
            "<td><button class='btn_editar' type='button' id='editar-" +
            resultado[i].id +
            "' >Editar</button></td>"
        );
      }
    }
  });
}

//GET objeto usuario
function get_usuario(index) {
  $.ajax({
    url: ".//F_PHP/get_row.php",
    method: "POST",
    data: {
      index: index,
      tabela: "usuarios",
    },
    dataType: "json",
  }).done(function (resultado) {
    console.log(resultado);
    $("#edit_nome").val(resultado[0].nome);
    $("#edit_email").val(resultado[0].email);
    $("#edit_cpf").val(resultado[0].cpf);
    $("#edit_senha").val(resultado[0].senha);
    $("#edit_cargo").val(resultado[0].cargo);
  });
}

//Executas as funções de editar e deletar produto
const editDelet_usuario = (event) => {
  if (event.target.type == "button") {
    var evento = ([acao, index] = event.target.id.split("-"));

    // Deletar usuário
    if (acao == "deletar") {
      const modal = document.querySelector(".bg_modal");
      const modal_delet = document.querySelector(".modal_delet");
      const btn_deletar = document.querySelector(
        ".modal_delet >  div > #deletar"
      );
      const btn_cancelar = document.querySelector(
        ".modal_delet > div > #cancelar"
      );
      modal.style.display = "flex";
      modal_delet.style.display = "flex";

      btn_cancelar.addEventListener("click", () => {
        modal.style.display = "none";
        modal_delet.style.display = "none";
      });

      btn_deletar.addEventListener("click", () => {
        delet_row(index, "usuarios");
        modal.style.display = "none";
        modal_delet.style.display = "none";
      });
    }
    //Editar usuário
    else {
      const modal = document.querySelector(".bg_modal");
      const modal_editar = document.querySelector(".modal_editar");

      const btn_salvar = document.querySelector(
        "#edit_form_usuario > .box-1 > #salvar"
      );
      const btn_cancelar = document.querySelector(
        ".modal_editar > .container_btn_cancelar > #cancelar"
      );
      modal.style.display = "flex";
      modal_editar.style.display = "flex";

      get_usuario(index);

      btn_cancelar.addEventListener("click", () => {
        modal.style.display = "none";
        modal_editar.style.display = "none";
      });

      // console.log(nome, email, cpf, senha, cargo, index);

      btn_salvar.addEventListener("click", () => {
        $("#edit_form_usuario").submit(function (e) {
          e.preventDefault();
          var nome = $("#edit_nome").val();
          var email = $("#edit_email").val();
          var cpf = $("#edit_cpf").val();
          var senha = $("#edit_senha").val();
          var cargo = $("#edit_cargo").val();

          $.ajax({
            url: ".//F_PHP/editar_usuario.php",
            method: "POST",
            data: {
              index: index,
              nome: nome,
              email: email,
              cpf: cpf,
              senha: senha,
              cargo: cargo,
            },
            dataType: "json",
          }).done(function (resultado) {
            console.log(resultado);
            getTabela_usuario();
          });
        });
        modal.style.display = "none";
        modal_editar.style.display = "none";
      });
    }
    evento.length = 0;
  }
};

function click_editDelet_usuario() {
  document
    .querySelector(".container_tabela_usuarios > #mytable")
    .addEventListener("click", editDelet_usuario);
}

// - - - - - - - - - VENDA - - - - - - - - - - -

// Envia formulário de venda pro banco
$("#form_venda").submit(function (e) {
  e.preventDefault();

  var codigo_p = $("#codigo_p").val();
  var quantidade = $("#quantidade").val();
  var valor = $("#valor").val();

  $.ajax({
    url: ".//F_PHP/inserir_venda.php",
    method: "POST",
    data: {
      codigo_p: codigo_p,
      quantidade: quantidade,
      valor: valor,
    },
    dataType: "json",
  }).done(function (resultado) {
    getTabela_venda();
    $("#codigo_p").val("");
    $("#quantidade").val("");
    $("#valor").val("");
    console.log(resultado);
  });
});

//GET tabela de vendas
function getTabela_venda() {
  $.ajax({
    url: ".//F_PHP/get_tabela.php",
    method: "POST",
    data: {
      tabela: "vendas",
    },
    dataType: "json",
  }).done(function (resultado) {
    contador(resultado);
    if (resultado == "False") {
    } else {
      var tabela_usuarios = document.querySelector(".tabela_vendas");
      while (tabela_usuarios.firstChild) {
        tabela_usuarios.firstChild.remove();
      }
      for (var i = 0; i < resultado.length; i++) {
        $(tabela_usuarios).prepend(
          "<tr><td><p>" +
            resultado[i].id +
            "</p></td>" +
            "<td><p>" +
            resultado[i].codigo_p +
            "</p></td>" +
            "<td><p>" +
            resultado[i].nome_u +
            "</p></td>" +
            "<td><p>" +
            resultado[i].data +
            "</p></td>" +
            "<td><p>" +
            resultado[i].quantidade +
            "</p></td>" +
            "<td><p>" +
            resultado[i].valor +
            "</p></td>" +
            "<td><button class='btn_deletar' type='button' id='deletar-" +
            resultado[i].id +
            "' >Deletar</button></td>" +
            "<td><button class='btn_editar' type='button' id='editar-" +
            resultado[i].id +
            "' >Editar</button></td>"
        );
      }
    }
  });
}

function get_venda(index) {
  $.ajax({
    url: ".//F_PHP/get_row.php",
    method: "POST",
    data: {
      index: index,
      tabela: "vendas",
    },
    dataType: "json",
  }).done(function (resultado) {
    console.log(resultado);
    $("#edit_codigo_p").val(resultado[0].codigo_p);
    $("#edit_quantidade").val(resultado[0].quantidade);
    $("#edit_valor").val(resultado[0].valor);
  });
}

//Executas as funções de editar e deletar venda
const editDelet_venda = (event) => {
  if (event.target.type == "button") {
    var evento = ([acao, index] = event.target.id.split("-"));

    //Deleta venda
    if (acao == "deletar") {
      const modal = document.querySelector(".bg_modal");
      const modal_delet = document.querySelector(".modal_delet");
      const btn_deletar = document.querySelector(
        ".modal_delet >  div > #deletar"
      );
      const btn_cancelar = document.querySelector(
        ".modal_delet > div > #cancelar"
      );

      modal.style.display = "flex";
      modal_delet.style.display = "flex";

      btn_cancelar.addEventListener("click", () => {
        modal.style.display = "none";
        modal_delet.style.display = "none";
      });

      btn_deletar.addEventListener("click", () => {
        delet_row(index, "vendas");
        modal.style.display = "none";
        modal_delet.style.display = "none";
      });
    }
    //Edita venda
    else {
      const modal = document.querySelector(".bg_modal");
      const modal_editar = document.querySelector(".modal_editar");
      const btn_salvar = document.querySelector("#edit_form_venda > #salvar");
      const btn_cancelar = document.querySelector(
        ".modal_editar > .container_btn_cancelar > #cancelar"
      );
      modal.style.display = "flex";
      modal_editar.style.display = "flex";

      get_venda(index);

      btn_cancelar.addEventListener("click", () => {
        modal.style.display = "none";
        modal_editar.style.display = "none";
      });

      btn_salvar.addEventListener("click", () => {
        $("#edit_form_venda").submit(function (e) {
          e.preventDefault();
          var codigo_p = $("#edit_codigo_p").val();
          var quantidade = $("#edit_quantidade").val();
          var valor = $("#edit_valor").val();

          $.ajax({
            url: ".//F_PHP/editar_venda.php",
            method: "POST",
            data: {
              index: index,
              codigo_p: codigo_p,
              quantidade: quantidade,
              valor: valor,
            },
            dataType: "json",
          }).done(function (resultado) {
            getTabela_venda();
          });
        });
        modal.style.display = "none";
        modal_editar.style.display = "none";
      });
    }
    evento.length = 0;
  }
};

function click_editDelet_venda() {
  document
    .querySelector(".container_tabela_vendas > #mytable")
    .addEventListener("click", editDelet_venda);
}
