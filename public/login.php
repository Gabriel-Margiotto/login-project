<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include("../assets/css/bootstrap.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"
        defer></script>
</head>

<style>
    .w {
        width: 400px;
    }
</style>

<body class="bg-light">
    <form action="login.php" method="POST" class="container">
        <div class="row flex-column m-5">
            <h1 class="text-center fw-bold text-uppercase mb-md-4">Entrar</h1>
            <div class="input-group mb-3 w p-0 align-self-center">
                <span class="input-group-text">E-mail</span>
                <input type="email" class="form-control" name="email" minlength="10" maxlength="50"
                    placeholder="nome@exemplo.com">
            </div>
            <div class="input-group mb-3 w p-0 align-self-center">
                <span class="input-group-text">Senha</span>
                <input type="password" class="form-control" name="password" minlength="8" maxlength="16">
            </div>
            <button type="button" name="bt-login"
                class="btn btn-outline-success w align-self-center  mt-2">Logar</button>
            <p class="text-center">Não possui uma conta? <a
                    class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                    href="cadastro.php">Cadastrar</a></p>

            <div class="alert alert-danger w p-2 align-self-center text-center visually-hidden" role="alert">
                Email ou senha inválidos.
            </div>
        </div>
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