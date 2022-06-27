<?php
header('Content-Type: application/json');
session_start();

try {
    $pdo = new PDO('mysql:host=localhost; dbname=organiza_ai;','root','');

    //Código:
    $id = $_POST['index'];
    $nome = $_POST['nome'];
    $codigo = $_POST['codigo'];
    $quantidade = $_POST['quantidade'];
    $fornecedor = $_POST['fornecedor'];
    $custo = $_POST['custo'];
    $valor = $_POST['valor'];

    $query = $pdo->prepare('UPDATE produtos SET nome = :nome , codigo= :codigo,
        quantidade= :quantidade, fornecedor= :fornecedor, custo= :custo,
        valor= :valor WHERE produtos.id = :id');

    $query->bindValue(':nome',$nome);
    $query->bindValue(':codigo',$codigo);
    $query->bindValue(':quantidade',$quantidade);
    $query->bindValue(':fornecedor',$fornecedor);
    $query->bindValue(':custo',$custo);
    $query->bindValue(':valor',$valor);
    $query->bindValue(':id',$id);
    $query->execute();

    if($query->rowCount()>=1){
    echo json_encode('Produto editado!');
    }else{
    echo json_encode('Falha ao editar produto');
    }

} catch (PDOException $pe) {
    echo json_encode(die($pe->getMessage()));
}

?>