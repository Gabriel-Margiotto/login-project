<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
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
    <form action="cadastro.php" method="POST" class="container-sm">
        <div class="row m-5 flex-column">
            <h1 class="text-center fw-bold text-uppercase mb-md-4">Cadastro</h1>
            <div class="input-group mb-3 w p-0 align-self-center">
                <span class="input-group-text">Nome Completo</span>
                <input type="text" class="form-control" name="name-cadastro" minlength="4" maxlength="50">
            </div>
            <div class="input-group mb-3 w p-0 align-self-center">
                <span class="input-group-text">E-mail</span>
                <input type="text" class="form-control" name="email-cadastro" minlength="4" maxlength="50"
                    placeholder="nome@exemplo.com">
            </div>
            <div class="input-group mb-3 w p-0 align-self-center">
                <span class="input-group-text">Senha</span>
                <input type="password" class="form-control" name="password-cadastro" minlength="8" maxlength="16">
            </div>
            <div class="input-group mb-3 w p-0 align-self-center">
                <span class="input-group-text">Confirmar senha</span>
                <input type="password" class="form-control" name="password-confirm" minlength="8" maxlength="16">
            </div>
            <button type="submit" name="bt-cadastrar"
                class="w mt-2 rounded btn btn-outline-success align-self-center">Cadastrar</button>
            <p class="text-center">Já possui uma conta? <a
                    class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                    href="login.php">Login</a></p>

            <div class="alert alert-danger w text-center align-self-center p-1 visually-hidden" role="alert">
                Dados incorretos, revise!
            </div>
            <div class="alert alert-warning w text-center align-self-center p-1 visually-hidden" role="alert">
                Esse e-mail já existe! <br> Clique para <a href="./login.php" class="alert-link">Entrar</a>.
            </div>
        </div>
    </form>


</body>

</html>

<?php
session_start();

if (empty($_SESSION["email"])) {
    if (isset($_POST["bt-cadastrar"])) {

        require_once('../app/conexao.php');

        $name_cadastro = $_POST["name-cadastro"];
        $email_cadastro = $_POST["email-cadastro"];
        $password_cadastro = $_POST["password-cadastro"];
        $password_confirm = $_POST["password-confirm"];

        $emails_consultar = $con->query("SELECT email FROM usuarios");
        $email_existe;

        while ($email = mysqli_fetch_assoc($emails_consultar)) {
            if ($email["email"] === $email_cadastro) {
                $email_existe = true;
                break;
            }
        } // Final while - verifica se o email existe no banco de dados, caso sim retorna true


        if (
            !empty($name_cadastro) &&
            !empty($email_cadastro) &&
            !empty($password_cadastro) &&
            !empty($password_confirm) &&
            $password_cadastro == $password_confirm
        ) {

            if ($email_existe != true) {

                $hash = password_hash($_POST["password-cadastro"], PASSWORD_DEFAULT);
                $sql_enviar = "INSERT INTO usuarios (nome, email, senha) VALUES ('$name_cadastro', '$email_cadastro', '$hash')";

                $con->query($sql_enviar);
                $con->close();

                $_SESSION["email"] = $email_cadastro;

                header("Location: dashboard.php");
                exit;
            } else {
                echo "<br> Email já cadastrado!";
            }

        } else {
            // erro msg

        }
    } // Final IF botão de cadastro.
} else {
    header("Location: dashboard.php");
    exit;
} // Final IF verificar se já existe uma sessão ativa.




