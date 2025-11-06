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

// Comandos gerais
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

function delTudo($conn)
{
    $sqlDel = 'DELETE FROM tarefas WHERE 1';
    mysqli_query($conn, $sqlDel);
}

// comandos individuais
function    getTask($conn,    $id)
{
    $sqlBusca    =    'SELECT	*	FROM	tarefas	WHERE	id	=	'    .    $id;
    $resultado    =    mysqli_query($conn,    $sqlBusca);
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

function    editTask($conn,    $tarefa)
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
    mysqli_query($conn,    $sqlEditar);
}

function    delTask($conn,    $id)
{
    $sqlRemover    =    "DELETE	FROM	tarefas	WHERE	id	=	{$id}";
    mysqli_query($conn,    $sqlRemover);
}

//Arquivos
function    setAnexo($conn,    $anexo)
{
    $sqlGravar    =    "INSERT	INTO	anexos
        (tarefaId,	nome,	arquivo)
        VALUES
        (
        {$anexo['tarefaId']},
        '{$anexo['nome']}',
        '{$anexo['arquivo']}'
        )
        ";
    mysqli_query($conn,    $sqlGravar);
}

function    getAnexos($conn,    $tarefaId)
{
    $sql    =    "SELECT	*	FROM	anexos
								WHERE	tarefaId	=	{$tarefaId}";
    $resultado    =    mysqli_query($conn,    $sql);
    $anexos    =    [];
    while ($anexo    =    mysqli_fetch_assoc($resultado)) {
        $anexos[]    =    $anexo;
    }
    return $anexos;
}

function    getAnexo($conn, $id)
{
    $sqlBusca    =    'SELECT	*	FROM	anexos	WHERE	id	= ' . $id;
    $resultado    =    mysqli_query($conn,    $sqlBusca);
    return    mysqli_fetch_assoc($resultado);
}

function    delAnexo($conn,    $id)
{
    $sqlRemover    =    "DELETE	FROM	anexos	WHERE	id	=	{$id}";
    mysqli_query($conn,    $sqlRemover);
}
