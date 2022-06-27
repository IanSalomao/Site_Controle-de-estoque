<?php
header('Content-Type: application/json');

try {
    $pdo = new PDO('mysql:host=localhost; dbname=organiza_ai;','root','');

    //Código:
    $id = $_POST['index'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    $cargo = $_POST['cargo'];


    $query = $pdo->prepare('UPDATE usuarios SET nome = :nome, cpf = :cpf, email = :email, senha = :senha, cargo = :cargo WHERE usuarios.id = :id');

    $query->bindValue(':nome',$nome);
    $query->bindValue(':email',$email);
    $query->bindValue(':cpf',$cpf);
    $query->bindValue(':senha',$senha);
    $query->bindValue(':cargo',$cargo);
    $query->bindValue(':id',$id);
    $query->execute();

    if($query->rowCount()>=1){
    echo json_encode('usuario editado!');
    }else{
    echo json_encode('Falha ao editar usuario');
    }

} catch (PDOException $pe) {
    echo json_encode(die($pe->getMessage()));
}

?>