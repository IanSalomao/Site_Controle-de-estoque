<?php
header('Content-Type: application/json');

try {
    $pdo = new PDO('mysql:host=localhost; dbname=organiza_ai;','root','');
    
    //  Código:
    $index = $_POST['index'];
    $tabela = $_POST['tabela'];

    $pdo = new PDO('mysql:host=localhost; dbname=organiza_ai;','root','');
    $query = $pdo->prepare("DELETE FROM ".$tabela." WHERE ".$tabela.".id = ".$index);
    $query->execute();

    echo json_encode('Linha de id: '.$index.' deletada!');

} catch (PDOException $pe) {
    echo json_encode(die($pe->getMessage()));
}
