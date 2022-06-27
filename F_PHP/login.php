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