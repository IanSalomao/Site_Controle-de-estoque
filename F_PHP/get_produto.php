<?php
header('Content-Type: application/json');

try {
    $pdo = new PDO('mysql:host=localhost; dbname=organiza_ai;','root','');
    
    //  Código:
    $index = $_POST['index'];
    $query = $pdo->prepare('SELECT * FROM produtos WHERE produtos . id = :index');
    $query->bindValue(':index',$index);
    $query->execute();

    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));

} catch (PDOException $pe) {
    echo json_encode(die($pe->getMessage()));
}
?>
