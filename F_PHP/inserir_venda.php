<?php
header('Content-Type: application/json');
session_start();

try {
    $pdo = new PDO('mysql:host=localhost; dbname=organiza_ai;','root','');

    //Código:
    $codigo_p = $_POST['codigo_p'];
    $quantidade = $_POST['quantidade'];
    $valor = $_POST['valor'];
    $nome_u = $_SESSION['login']['nome'];

    $query = $pdo->prepare('INSERT INTO vendas (id, codigo_p, nome_u, data,
    quantidade, valor) VALUES (NULL, :codigo_p, :nome_u,
     current_timestamp(), :quantidade, :valor)');

    $query->bindValue(':codigo_p',$codigo_p);
    $query->bindValue(':nome_u',$nome_u);
    $query->bindValue(':quantidade',$quantidade);
    $query->bindValue(':valor',$valor);
    $query->execute();

    if($query->rowCount()>=1){
    echo json_encode('Venda Salva!');
    }else{
    echo json_encode('Falha ao salvar venda.');
    }

} catch (PDOException $pe) {
    echo json_encode(die($pe->getMessage()));
}

?>