<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Painel de controle</title>
</head>

<body>
    <h1>PAINEL DE CONTROLE</h1>

    <a href="logout.php">Sair</a>
</body>

</html>


<?php
session_start();

if (empty($_SESSION["email"])) {

    header("Location: login.php");
    exit;

} else {
    echo "{$_SESSION["email"]}";

    //codigo 

}