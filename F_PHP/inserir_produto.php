<?php
header('Content-Type: application/json');
session_start();

try {
    $pdo = new PDO('mysql:host=localhost; dbname=organiza_ai;','root','');

    //Código:
    $nome = $_POST['nome'];
    $nome_u = $_SESSION['login']['nome'];
    $codigo = $_POST['codigo'];
    $quantidade = $_POST['quantidade'];
    $fornecedor = $_POST['fornecedor'];
    $custo = $_POST['custo'];
    $valor = $_POST['valor'];

    $query = $pdo->prepare('INSERT INTO produtos (id, nome_u, nome, codigo, data,
    quantidade, fornecedor, custo, valor) VALUES (NULL, :nome_u, :nome,
    :codigo, current_timestamp(), :quantidade, :fornecedor, :custo, :valor)');

    $query->bindValue(':nome_u',$nome_u);
    $query->bindValue(':nome',$nome);
    $query->bindValue(':codigo',$codigo);
    $query->bindValue(':quantidade',$quantidade);
    $query->bindValue(':fornecedor',$fornecedor);
    $query->bindValue(':custo',$custo);
    $query->bindValue(':valor',$valor);
    $query->execute();

    if($query->rowCount()>=1){
    echo json_encode('Produto salvo!');
    }else{
    echo json_encode('Falha ao salvar produto');
    }

} catch (PDOException $pe) {
    echo json_encode(die($pe->getMessage()));
}

?>