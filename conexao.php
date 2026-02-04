<?php


require_once("config.php");
$con = new mysqli($host, $user, $password, $db);

if ($con->connect_errno) {
    return "<script>alert('Erro ao conectar o banco de dados');</script>";
}