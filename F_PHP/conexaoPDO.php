<?php
header('Content-Type: application/json');

try {
    $pdo = new PDO('mysql:host=localhost; dbname=organiza_ai;','root','');
    //  Código:


} catch (PDOException $pe) {
    echo json_encode(die($pe->getMessage()));
}

?>