$("#form_login").submit(function (e) {
  e.preventDefault();
  var email = $("#email").val();
  var senha = $("#senha").val();

  $.ajax({
    url: "login.php",
    method: "POST",
    data: { email: email, senha: senha },
    dataType: "json",
  }).done(function (resultado) {
    if (resultado != "") {
      var nome_usuario = resultado[0].nome;
      window.location.assign(
        "http://localhost/Site_Controle-de-estoque/pg.php"
      );
    } else {
      $(".msg_erro_login").prepend("<h4>Usuário ou senha incorreto</h4>");
    }
  });
});
$(".hello_nome").prepend(nome_usuario);
$("#form_cadastro").submit(function (e) {
  e.preventDefault();

  var nome = $("#nome").val();
  var cpf = $("#cpf").val();
  var email = $("#email").val();
  var senha = $("#senha").val();
  var cargo = $("#cargo").val();

  $.ajax({
    url: "inserir_cadastro.php",
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
    console.log(resultado);
  });
});
