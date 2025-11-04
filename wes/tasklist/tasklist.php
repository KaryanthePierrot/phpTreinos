<?php
session_start();
require "bd.php";
require "helpers/traducao.php";

if (array_key_exists('nome',    $_GET)    &&    $_GET['nome']    !=    '') {
    $tarefa    =    [];
    $tarefa = [
    'nome' =>    $_GET['nome'],
    'descricao' => '',
    'prazo' => '',
    'prioridade' => $_GET['prioridade'],
    'concluida'=> 0,
    ];

    if (array_key_exists('descricao',    $_GET)) {
        $tarefa['descricao']    =    $_GET['descricao'];
    } 

    if (array_key_exists('prazo',    $_GET)) {
        $tarefa['prazo'] = $_GET['prazo'];
    } 

    if (array_key_exists('concluida', $_GET)) {
        $tarefa['concluida'] = $_GET['concluida']; // Recebe 'sim'
    } 
     $_SESSION['lista_tarefas'][]    =    $tarefa;
    setTask($conn, $tarefa);
}


$lista_tarefas = [];

$lista_tarefas = getTasks($conn);


$exibir_tabela = "false";
require "template.php";