<?php

use Tarefas\Models\Tarefa;

$bdServer = '127.0.0.1';
$bdUser = 'sistematasks';
$bdPass = 'root';
$bdBanco = 'tasklist';

$conn = mysqli_connect(
    $bdServer,
    $bdUser,
    $bdPass,
    $bdBanco
);


if (mysqli_connect_errno()) {
    echo 'Problema na conexão com o banco de dados. Erro: ';
    echo mysqli_connect_error();
    die();
}

function getTasks($conn)
{
    $sqlGetAll = 'SELECT * FROM tarefas';
    $resultado = mysqli_query($conn, $sqlGetAll);

    $tarefas = [];
    while ($tarefa = mysqli_fetch_assoc($resultado)) {
        $tarefas[] = $tarefa;
    }
    return $tarefas;
}

function    getTask($conexao,    $id)
{
    $sqlBusca    =    'SELECT	*	FROM	tarefas	WHERE	id	=	'    .    $id;
    $resultado    =    mysqli_query($conexao,    $sqlBusca);
    return    mysqli_fetch_assoc($resultado);
}

function setTask($conn, $task)
{

    if ($task['prazo'] == '') {
        $prazo = 'NULL';
    } else {
        $prazo = "'{$task['prazo']}'";
    }

    $sqlSet = "
INSERT INTO `tarefas`( `nome`, `descricao`,`prioridade`, `prazo`, concluida)
    VALUES(
    '{$task['nome']}',
    '{$task['descricao']}',
    {$task['prioridade']},
    {$prazo},
    {$task['concluida']}
    )";
    mysqli_query($conn, $sqlSet);
}

function    editTask($conexao,    $tarefa)
{
    if ($tarefa['prazo']    ==    '') {
        $prazo    =    'NULL';
    } else {
        $prazo    =    "'{$tarefa['prazo']}'";
    }
    $sqlEditar    =    "
UPDATE	tarefas	SET
nome	=	'{$tarefa['nome']}',
descricao	=	'{$tarefa['descricao']}',
prioridade	=	{$tarefa['prioridade']},
prazo	=	{$prazo},
concluida	=	{$tarefa['concluida']}
WHERE	id	=	{$tarefa['id']}
";
    mysqli_query($conexao,    $sqlEditar);
}

function    delTask($conexao,    $id)
{
    $sqlRemover    =    "DELETE	FROM	tarefas	WHERE	id	=	{$id}";
    mysqli_query($conexao,    $sqlRemover);
}

function delTudo($conn){
    $sqlDel = 'DELETE FROM tarefas WHERE 1';
    mysqli_query($conn, $sqlDel);
}
