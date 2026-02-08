<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
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


<?php

include_once("../app/conexao.php");
session_start();


$id = mysqli_real_escape_string($con, $_GET["id"]);

$sql = "SELECT idusuarios, nome, email FROM usuarios WHERE idusuarios=$id";
$row = $con->query($sql);

$resultado = mysqli_fetch_assoc($row);

?>

<body>
    <form method="POST" class="container-sm">
        <div class="d-flex flex-column">
            <h1 class="text-center">Editar</h1>
            <div class="input-group mb-3 w align-self-center">
                <span class="input-group-text" id="inputGroup-sizing-default">Nome</span>
                <input type="text" class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default" value="<?= $resultado["nome"]; ?>" name="nome_alterado"
                    minlength="8" maxlength="50" required>
            </div>
            <div class="input-group mb-3 w align-self-center">
                <span class="input-group-text" id="inputGroup-sizing-default">E-mail</span>
                <input type="email" class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default" value="<?= $resultado["email"]; ?>"
                    name="email_alterado" required>
            </div>
            <button type="submit" class="btn btn-outline-success w align-self-center" name="bt-editar">Editar</button>
            <button type="submit" class="btn btn-outline-danger w align-self-center"
                name="bt-cancelar">Cancelar</button>
        </div>

    </form>
</body>

</html>



<?php


if (isset($_POST["bt-editar"])) {

    $nome_alterado = mysqli_real_escape_string($con, $_POST["nome_alterado"]);
    $email_alterado = mysqli_real_escape_string($con, $_POST["email_alterado"]);

    try {
        $con->query("UPDATE usuarios SET nome = '$nome_alterado', email = '$email_alterado' WHERE idusuarios=$id");

        if ($resultado["email"] == $_SESSION["email"]) {

            $_SESSION["email"] = $email_alterado;

        }

        header("Location: ../dashboard.php");

        $con->close();
        exit;

    } catch (Exception $e) {
        echo "email ja existe";
    }

}

if (isset($_POST["bt-cancelar"])) {
    header("Location: ../dashboard.php");
}
