<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Painel de controle</title>
    <?php include("../assets/css/bootstrap.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"
        defer></script>
</head>

<body>
    <h1>PAINEL DE CONTROLE</h1>

    <a href="../app/logout.php">Sair</a>
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