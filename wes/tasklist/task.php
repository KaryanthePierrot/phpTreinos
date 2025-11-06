<?php

include("bd.php");
include("helpers/helpers.php");


if (! is_array($tarefa)) {
    http_response_code(404);
    echo "Tarefa	não	encontrada.";
    die();
}

$hasErrors = false;
$errosValidacoes = [];

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
        header('Location: http://localhost/phpTreinos/wes/tasklist/task.php?');
    }
}

$tarefa = getTask($conn, $_GET['id']);
$anexos = getAnexos($conn, $_GET['id']);


include 'templateTask.php';
