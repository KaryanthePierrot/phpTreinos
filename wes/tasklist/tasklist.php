<?php
session_start();

require "config.php";
require "bd.php";
require "helpers/helpers.php";
require 'classes/Tarefa.php';
require 'classes/Anexo.php';
require 'classes/RepositoryTask.php';

$repositoryTarefas = new RepositorioTarefas($conn);

$showTable = true;

$hasErrors = false;
$errosValidacoes = [];

$tarefa = new Tarefa();
$tarefa->setPrioridade(1);


if (temPost()) {
    // $tarefa    =    [];
    // $tarefa = [
    //     'nome' =>    $_POST['nome'],
    //     'descricao' => '',
    //     'prazo' => '',
    //     'prioridade' => $_POST['prioridade'],
    //     'concluida' => 0,
    // ];

    if (
        array_key_exists('nome',    $_POST)
        &&    strlen($_POST['nome'])    >    0
    ) {
        $tarefa->setNome($_POST['nome']);
    } else {
        $hasErrors    =    true;
        $errosValidacoes['nome']    =
            'O	nome	da	tarefa	é	obrigatório!';
    }
    if (array_key_exists('descricao',    $_POST)) {
        $tarefa->setDescricao($_POST['descricao']);
    }
    if (
        array_key_exists('prazo',    $_POST)
        &&    strlen($_POST['prazo'])    >    0
    ) {
        if (validar_data($_POST['prazo'])) {
            $tarefa->setPrazo(
                transDateToObj($_POST['prazo'])
            );
        } else {
            $hasErrors    =    true;
            $errosValidacoes['prazo']    =
                'O	prazo	não	é	uma	data	válida!';
        }
    }

    $tarefa->setPrioridade($_POST['prioridade']);
    if (array_key_exists('concluida',    $_POST)) {
        $tarefa->setConcluida(true);
    }
    if (! $hasErrors) {
        $repositoryTarefas->save($tarefa);
        // if (
        //     isset($_POST['lembrete'])
        //     &&    $_POST['lembrete']    ==    '1'
        // ) {
        //     sendMail($tarefa);
        // }
        header('Location:	tasklist.php');
        die();
    }
}


$tarefas = $repositoryTarefas->get();

// $lista_tarefas = [];

// $lista_tarefas = getTasks($conn);

// $tarefa    =    [
//     'id' =>    0,
//     'nome' =>    $_POST['nome'] ?? '',
//     'descricao' =>  $_POST['descricao'] ?? '',
//     'prazo' => (isset($_POST['prazo'])) ? transDateToDb($_POST['prazo']) : '',
//     'prioridade' =>    $_POST['prioridade'] ?? '',
//     'concluida' =>    $_POST['concluida'] ?? ''
// ];

// require 'templateTask.php';
require "templates/template.php";
