<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Taskist</title>

    <link rel="stylesheet" href="css/cssTag.css">
    <link rel="stylesheet" href="css/cssClass.css">
    <link rel="stylesheet" href="css/cssId.css">

</head>

<body>
    <div class="titulo">
        <h1 class="titulo-texto">Gerenciador de Tarefas</h1>
    </div>

    <?php require 'formulario.php'; ?>
    <?php if ($exibir_tabela) : ?>
        <?php require 'tabela.php' ?>
    <?php endif; ?>
    <br>


</body>

</html>