<?php
// header('Content-Type: application/json');

session_start();

print_r(json_encode($_SESSION['login']['cargo']));


?>