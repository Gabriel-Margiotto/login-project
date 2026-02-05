<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form action="login.php" method="POST">
        <label>
            Email:
            <input type="email" name="email">
        </label>
        <label>
            Senha:
            <input type="password" name="password">
        </label>
        <button type="submit" name="bt-login">Logar</button>
        <br>
        <a href="cadastro.php">Cadastrar</a>
    </form>
</body>

</html>


<?php

include_once("../app/conexao.php");
session_start();

if (empty($_SESSION["email"])) {

    if (isset($_POST["bt-login"])) {

        $email_login = $_POST["email"];
        $password_login = $_POST["password"];

        $sql = "SELECT email, senha FROM usuarios;";
        $results = $con->query($sql);


        while ($row = mysqli_fetch_assoc($results)) {

            $password_rhash = password_verify($password_login, $row["senha"]);

            if ($email_login == $row["email"] && $password_rhash) {

                $_SESSION["email"] = $email_login;
                $con->close();

                header("Location: dashboard.php");

                break;

            } else {
                echo "Dados incorretos";
                break;
            }
        }


    }

} else {
    header("Location: dashboard.php");
    exit;
}