<?php
header('Content-Type: application/json');
session_start();

try {
    $pdo = new PDO('mysql:host=localhost; dbname=organiza_ai;','root','');

    //Código:
    $id = $_POST['index'];
    $codigo_p = $_POST['codigo_p'];
    $quantidade = $_POST['quantidade'];
    $valor = $_POST['valor'];

    $query = $pdo->prepare('UPDATE vendas SET codigo_p = :codigo_p ,
        quantidade= :quantidade, valor= :valor WHERE vendas.id = :id');

    $query->bindValue(':codigo_p',$codigo_p);
    $query->bindValue(':quantidade',$quantidade);
    $query->bindValue(':valor',$valor);
    $query->bindValue(':id',$id);
    $query->execute();

    echo json_encode('Venda editada!');


} catch (PDOException $pe) {
    echo json_encode(die($pe->getMessage()));
}

?>