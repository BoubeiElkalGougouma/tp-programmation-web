<?php

$env = parse_ini_file('.env');

$con = mysqli_connect(
    $env['DB_HOST'], 
    $env['DB_USER'], 
    $env['DB_PASS'], 
    $env['DB_NAME']
);

if (!$con) {
    die("Échec de la connexion : " . mysqli_connect_error());
}
?>
