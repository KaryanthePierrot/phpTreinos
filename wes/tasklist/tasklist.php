<?php
session_start();

require "config.php";
require "bd.php";
require "helpers/helpers.php";

$showTable = true;

$hasErrors = false;
$errosValidacoes = [];


if (temPost()) {
    $tarefa    =    [];
    $tarefa = [
        'nome' =>    $_POST['nome'],
        'descricao' => '',
        'prazo' => '',
        'prioridade' => $_POST['prioridade'],
        'concluida' => 0,
    ];

    if (strlen($tarefa['nome'])    ==    0) {
        $hasErrors    =    true;
        $errosValidacoes['nome']    =    'O	nome	da	tarefa	é	obrigatório!';
    }

    if (array_key_exists('descricao',    $_POST)) {
        $tarefa['descricao']    =    $_POST['descricao'];
    }

    if (
        array_key_exists('prazo',    $_POST)
        &&    strlen($_POST['prazo'])    >    0
    ) {
        if (validar_data($_POST['prazo'])) {
            $tarefa['prazo']    =
                transDateToDb($_POST['prazo']);
        } else {
            $hasErrors    =    true;
            $errosValidacoes['prazo']    =
                'O	prazo	não	é	uma	data	válida!';
        }
    }

    if (array_key_exists('prioridade', $_POST) && strlen($_POST['prazo'])    >    0) {
        $hasErrors    =    true;
        $errosValidacoes['prioridade']    =
            'Defina uma prioridade';
    }

    if (array_key_exists('concluida', $_POST)) {
        $tarefa['concluida'] = $_POST['concluida']; // Recebe 'sim'
    }
    $_SESSION['lista_tarefas'][]    =    $tarefa;

    if (! $hasErrors) {
        setTask($conn, $tarefa);

        if (
            array_key_exists('lembrete',    $_POST)
            &&    $_POST['lembrete']    ==    '1'
        ) {
            // sendMail($tarefa);
        }

        header('Location:	tasklist.php');
        die();
    }
}


$lista_tarefas = [];

$lista_tarefas = getTasks($conn);

$tarefa    =    [
    'id' =>    0,
    'nome' =>    $_POST['nome'] ?? '',
    'descricao' =>  $_POST['descricao'] ?? '',
    'prazo' => (isset($_POST['prazo'])) ? transDateToDb($_POST['prazo']) : '',
    'prioridade' =>    $_POST['prioridade'] ?? '',
    'concluida' =>    $_POST['concluida'] ?? ''
];

// require 'templateTask.php';
require "templates/template.php";
