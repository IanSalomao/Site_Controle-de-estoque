<?php
// header('Content-Type: application/json');
try {
    $pdo = new PDO('mysql:host=localhost; dbname=organiza_ai;','root','');
    
    //  Código:
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cargo = $_POST['cargo'];

    $pdo = new PDO('mysql:host=localhost; dbname=organiza_ai;','root','');
    $query = $pdo->prepare('INSERT INTO usuarios (id, nome, cpf, email, senha, cargo) VALUES (NULL, :nome, :cpf, :email, :senha, :cargo)');
    $query->bindValue(':nome',$nome);
    $query->bindValue(':cpf',$cpf);
    $query->bindValue(':email',$email);
    $query->bindValue(':senha',$senha);
    $query->bindValue(':cargo',$cargo);
    $query->execute();

    if($query->rowCount()>=1){
    echo json_encode('Salvo com sucesso');
    }else{
    echo json_encode('Falha ao salvar usuário');
    }

} catch (PDOException $pe) {
    echo json_encode(die($pe->getMessage()));
}

 


?>