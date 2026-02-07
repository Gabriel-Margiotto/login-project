<?php

include_once("conexao.php");
session_start();


$id = mysqli_real_escape_string($con, $_GET["id"]);

$get_email = $con->query("SELECT email FROM usuarios WHERE idusuarios=$id");
$resultado = mysqli_fetch_assoc($get_email);

if ($_SESSION['email'] == $resultado["email"]) {
    $_SESSION['email'] = null;
}

$sql = "DELETE FROM usuarios WHERE idusuarios=$id";

$con->query($sql);
$con->close();


header("Location: /crud/public/dashboard.php");
exit;