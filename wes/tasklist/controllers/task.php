<?php

include("../config.php");
include("../bd.php");
include("../helpers/helpers.php");

$hasErrors = false;
$errosValidacoes = [];

$tarefaId = isset($_POST["tarefaId"]) && is_numeric($_POST["tarefaId"]) ? $_POST["tarefaId"] : null;

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400);
    echo "ID da tarefa inválido ou ausente.";
    die();
}

$tarefaId = $_GET["id"];
$tarefa = getTask($conn, $_GET['id']);
$anexos = getAnexos($conn, $_GET['id']);

if (! is_array($tarefa)) {
    http_response_code(404);
    echo "Tarefa	não	encontrada.";
    die();
}

if (temPost()) {
    //futuro upload de arquivos

    $tarefaId = $_POST["tarefaId"];

    if (!array_key_exists('anexo', $_FILES)) {
        $hasErrors = true;
        $errosValidacoes['anexo'] = 'Você deve selecionar um arquivo para anexar';
    } else {
        if (tratarAnexo($_FILES['anexo'])) {
            $nome = $_FILES['anexo']['name'];
            $anexo = [
                'tarefaId' => $tarefaId,
                'nome' => substr($nome, 0, -4),
                'arquivo' => $nome,
            ];
        } else {
            $hasErrors = true;
            $errosValidacoes['anexo'] = 'Envie anexos nos formatos zip ou pdf';
        }
    }

    if (!$hasErrors) {
        setAnexo($conn, $anexo);
        header("Location: task.php?id={$tarefaId}");
    }
}



include '../templates/templateTask.php';
