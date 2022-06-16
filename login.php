<?php

header('Content-Type: application/json');

$email = $_POST['email']; 
$senha = $_POST['senha']; 

$pdo = new PDO('mysql:host=localhost; dbname=organiza_ai;','root','');
$query = $pdo->prepare('SELECT * FROM usuarios WHERE email = :email AND senha= :senha');
$query->bindValue(':email',$email);
$query->bindValue(':senha',$senha);
$query->execute();

echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));
?>