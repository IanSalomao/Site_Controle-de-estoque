<h1 align="center"> Site de Controle de estoque </h1>

## Sobre

Esse projeto tem como desafio principal implementar o crud em um sistema de controle de estoque. Para isso, o projeto foi pensado para uma empresa fictícia `Flora🌻`, que seria um horto com necessidade de um sistema de organização de estoque:

![Tela de login](https://i.imgur.com/aqJTV4w.png)

## Diferencial

O principal diferencial desse projeto não é necessariamente o crud, mas a forma de fazê-lo! Decidi implementar as conexões com o banco de dados utilizando métodos `AJAX`, acrônimo de Asynchronous JavaScript and XML, é uma técnica de desenvolvimento Web que permite a criação de aplicações mais interativas. Um dos principais objetivos é tornar as respostas das páginas Web mais rápidas pela troca de pequenas quantidades de informações com o servidor Web, nos bastidores.

Além disso, evita-se que a página Web inteira tenha que ser recarregada cada vez que alguma nova informação precisa ser consultada no servidor. Em geral, isso significa que páginas Web com recursos AJAX permitem maior interatividade, velocidade de processamento e usabilidade.

```JavaScript
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
```

A função acima é a função responsável por fazer login, ela armazena as informações do formulário `form_login` utilizando jQuery, inicia o método Ajax passando a url do meu scrip php que contem a query que será executada, o método que será utilizado, os dados e o tipo de dado que será usado(`Json`).
No script PHP:

```PHP
<?php
header('Content-Type: application/json');
try {
    $pdo = new PDO('mysql:host=localhost; dbname=organiza_ai;','root','');

    //  Código:
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $query = $pdo->prepare('SELECT * FROM usuarios WHERE email = :email AND senha= :senha');
    $query->bindValue(':email',$email);
    $query->bindValue(':senha',$senha);
    $query->execute();
    $result=$query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
    error_reporting(0);
    session_start();
    $_SESSION['login'] = $result[0];

} catch (PDOException $pe) {
    echo json_encode(die($pe->getMessage()));
}
?>
```

Os dados são recebidos pelo método POST, utiliza-se uma conexão PDO para fazer a conexão com o banco `organiza_ai`, então a query é criada e executada, e retorna o `$resultado` em `json_encode`.
O resultado é recebido pela função, que uma resposta para o usuário. Como a página não é recarregada, se o usuário digitar alguma informação incorreta, ao retornar um erro, as informações não são perdidas e o usuário pode apenas corrigir o dado incorreto, ao invés de ter que inserir todos os dados novamente!

## Estrutura

### Nível de acesso

- Administrador
- Vendedor

Os usuários de tipo `vendedor` não tem acesso à tabela `produtos`.

### Estrutura das tabelas

#### Usuários

| Nome  | Tipo    |
| ----- | ------- |
| id    | int     |
| nome  | varchar |
| cpf   | varchar |
| email | varchar |
| senha | varchar |
| cargo | varchar |

#### Produtos

| Nome       | Tipo      |
| ---------- | --------- |
| id         | int       |
| nome_u     | varchar   |
| nome       | varchar   |
| codigo     | varchar   |
| data       | timestamp |
| quantidade | int       |
| fornecedor | varchar   |
| custo      | float     |
| valor      | float     |

#### Vendas

| Nome       | Tipo      |
| ---------- | --------- |
| id         | int       |
| codigo_p   | varchar   |
| nome_u     | varchar   |
| codigo     | varchar   |
| data       | timestamp |
| quantidade | int       |
| valor      | float     |

### Funções

Página de Produtos para exemplificar.
![exemplo](https://i.imgur.com/7RgFzJi.png)

#### Adicionar(Create)

![Cadastro](https://i.imgur.com/HpLbva5.png)

#### Mostrar(Read)

![Vizualizar](https://i.imgur.com/lQbpO1u.png)

#### Editar(Update)

![Edição](https://i.imgur.com/PEvZsgL.png)

#### Deletar(Delet)

![Remoção](https://i.imgur.com/DhRTqEY.png)

### E assim o crud é realizado🎇

## Tecnologias

- HTMl
- CSS
- Bootstrap
- JavaScript
- PHP
- jQuery
- Ajax
- MySQL
