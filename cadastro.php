<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>

<body>
    <form action="cadastro.php" method="POST">
        <label>
            Nome:
            <input type="text" name="name-cadastro" minlength="4" maxlength="50">
        </label>
        <label>
            Email:
            <input type="email" name="email-cadastro" minlength="4" maxlength="50">
        </label>
        <label>
            Senha:
            <input type="password" minlength="8" maxlength="16" name="password-cadastro">
        </label>
        <label>
            Confirmar senha:
            <input type="password" name="password-confirm" minlength="8" maxlength="16">
        </label>
        <button type="submit" name="bt-cadastrar">Cadastrar</button>
    </form>
</body>

</html>

<?php
session_start();

if (empty($_SESSION["email"])) {
    if (isset($_POST["bt-cadastrar"])) {

        require_once('conexao.php');

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
            echo "<br> Preencha os dados corretamente!";

        }
    } // Final IF botão de cadastro.
} else {
    header("Location: dashboard.php");
    exit;
} // Final IF verificar se já existe uma sessão ativa.




