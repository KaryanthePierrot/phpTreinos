<?php

include("../config.php");
include("../bd.php");
include("../helpers/helpers.php");
include("../classes/Tarefa.php");
include("../classes/RepositoryTarefas.php");
include("../classes/Anexo.php");

$repositoryTarefas = new RepositorioTarefas($conn);

$tarefa = $repositoryTarefas->get($_GET["id"]);

$hasErrors = false;
$errosValidacoes = array();

$tarefaId = isset($_POST["tarefaId"]) && is_numeric($_POST["tarefaId"]) ? $_POST["tarefaId"] : null;

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400);
    echo "ID da tarefa inválido ou ausente.";
    die();
}

$tarefaId = $_GET["id"];
$tarefa = getTask($conn, $_GET['id']);
$anexos = getAnexos($conn, $_GET['id']);


if (temPost()) {
    //futuro upload de arquivos

    $tarefaId = $_POST["tarefaId"];

    if (!array_key_exists('anexo', $_FILES)) {
        $hasErrors = true;
        $errosValidacoes['anexo'] = 'Você deve selecionar um arquivo para anexar';
    } else {
        $dadosAnexo = $_FILES['anexo'];

        if (tratarAnexo($dadosAnexo)) {
            $anexo = new Anexo();
            $anexo-> setTarefaId($tarefaId);
            $anexo->setNome($dadosAnexo['name']);
            $anexo->setArquivo($dadosAnexo['name']);
        } else {
            $hasErrors = true;
            $errosValidacoes['anexo'] = 'Envie anexos nos formatos zip ou pdf';
        }
    }

    if (!$hasErrors) {
        // setAnexo($conn, $anexo);
        $repositoryTarefas->saveAnexo($anexo);
        // header("Location: task.php?id={$tarefaId}");
    }
}



include '../templates/templateTask.php';
