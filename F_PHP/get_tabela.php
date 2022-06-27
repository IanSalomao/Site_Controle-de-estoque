<?php

header('Content-Type: application/json');

try {
    $pdo = new PDO('mysql:host=localhost; dbname=organiza_ai;','root','');
    
    //  Código:
    $tabela = $_POST['tabela'];

    $query = $pdo->prepare('SELECT * FROM ' . $tabela);
    $query->execute();

    if ($query->rowCount() >= 1) {
        echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));
    } else {
        echo json_encode('False');
    }

} catch (PDOException $pe) {
    echo json_encode(die($pe->getMessage()));
}

?>
