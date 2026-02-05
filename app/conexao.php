<?php

$env = parse_ini_file('../core/.env');
$host = $env["HOST"];
$user = $env["USER"];
$password = $env["PASSWORD"];
$db = $env["DB"];

$con = new mysqli($host, $user, $password, $db);

if ($con->connect_errno) {
    return "<script>alert('Erro ao conectar o banco de dados');</script>";
}