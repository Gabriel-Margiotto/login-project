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

<style>
    .w {
        width: 600px;
    }
</style>

<body class="bg-light">
    <div class="container-sm">
        <h1 class="text-center fw-bold text-uppercase mb-md-4">PAINEL DE CONTROLE</h1>
        <table class="table table-striped w m-auto">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col" class="text-center">Configurações</th>
                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../app/conexao.php");
                session_start();

                $sql = "SELECT * from usuarios";
                $results = $con->query($sql);

                while ($dados = mysqli_fetch_assoc($results)) {
                    ?>
                    <tr>
                        <th scope="row"><?= $dados["idusuarios"] ?></th>
                        <td><?= $dados["nome"] ?></td>
                        <td><?= $dados["email"] ?></td>
                        <td>
                            <ul class="d-flex justify-content-around p-0">
                                <li class="d-inline"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="black" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg></li>
                                <li class="d-inline"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="black" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                    </svg></i></li>
                            </ul>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>






        <p class="text-center">Sessão: <?php
        echo "{$_SESSION['email']}" ?> <a href="../app/logout.php">Deslogar</a></p>
    </div>

</body>

</html>



<?php

if (empty($_SESSION["email"])) {

    header("Location: login.php");
    exit;
}