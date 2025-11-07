<?php
//	arquivo	classes/RepositorioTarefas.php
class RepositorioTarefas
{
    private $conn;
    public function    __construct(mysqli    $conn)
    {
        $this->conn    =    $conn;
    }
    public function    save(Tarefa    $tarefa)
    {
        $nome    =    $tarefa->getNome();
        $descricao    =    $tarefa->getDescricao();
        $prioridade    =    $tarefa->getPrioridade();
        $prazo    =    $tarefa->getPrazo();
        $concluida    =    ($tarefa->getConcluida())    ?    1    :    0;

        if (is_object($prazo)) {
            $prazo    =    "'{$prazo->format('Y-m-d')}'";
        } elseif ($prazo    ==    '') {
            $prazo    =    'NULL';
        } else {
            $prazo    =    "'{$prazo}'";
        }
        $sqlGravar    =    "
												INSERT	INTO	tarefas
												(nome,	descricao,	prioridade,	prazo,	concluida)
												VALUES
												(
																'{$nome}',
																'{$descricao}',
																{$prioridade},
																{$prazo},
																{$concluida}
												)
								";
        $this->conn->query($sqlGravar);
    }
    public function    update(Tarefa    $tarefa)
    {
        $id    =    $tarefa->getId();
        $nome    =    $tarefa->getNome();
        $descricao    =    $tarefa->getDescricao();
        $prioridade    =    $tarefa->getPrioridade();
        $prazo    =    $tarefa->getPrazo();
        $concluida    =    ($tarefa->getConcluida())    ?    1    :    0;

        if (is_object($prazo)) {
            $prazo    =    "'{$prazo->format('Y-m-d')}'";
        } elseif ($prazo    ==    '') {
            $prazo    =    'NULL';
        } else {
            $prazo    =    "'{$prazo}'";
        }

        $sqlEditar    =    "
            UPDATE	tarefas	SET
            nome	=	'{$nome}',
            descricao	=	'{$descricao}',
            prioridade	=	{$prioridade},
            prazo	=	{$prazo},
            concluida	=	{$concluida}
            WHERE	id	=	{$id}
";
        $this->conn->query($sqlEditar);
    }

    public function    get(int    $tarefaId    =    0)
    {
        if ($tarefaId    >    0) {
            return $this->getTarefa($tarefaId);
        } else {
            return $this->getTarefas();
        }
    }

    private function    getTarefas(): array
    {
        $sqlBusca    =    'SELECT	*	FROM	tarefas';
        $resultado    =    $this->conn->query($sqlBusca);
        $tarefas    =    [];
        while ($tarefa    =    $resultado->fetch_object('Tarefa')) {
            $tarefa->setAnexos(
                $this->getAnexos($tarefa->getId())
            );
            $tarefas[]    =    $tarefa;
        }
        return $tarefas;
    }

    private function    getTarefa(int    $tarefaId): Tarefa
    {
        $sqlBusca    =    'SELECT	*	FROM	tarefas	WHERE	id	=	'    .    $tarefaId;
        $resultado    =    $this->conn->query($sqlBusca);
        $tarefa    =    $resultado->fetch_object('Tarefa');
        $tarefa->setAnexos(
            $this->getAnexo($tarefa->getId())
        );
        return $tarefa;
    }

    function    delete(int    $tarefaId)
    {
        $sqldelete    =    "DELETE	FROM	tarefas	WHERE	id	=	{$tarefaId}";
        $this->conn->query($sqldelete);
    }

    public function    getAnexos(int    $tarefaId): array
    {
        $sqlBusca    =
            "SELECT	*	FROM	anexos	WHERE	tarefaId	=	{$tarefaId}";
        $resultado    =    $this->conn->query($sqlBusca);
        $anexos    =    array();
        while ($anexo    =    $resultado->fetch_object('Anexo')) {
            $anexos[]    =    $anexo;
        }
        return $anexos;
    }

    public function    getAnexo(int    $anexo_id): Anexo
    {
        $sqlBusca    =    "SELECT	*	FROM	anexos	WHERE	id	=	{$anexo_id}";
        $resultado    =    $this->conn->query($sqlBusca);
        return $resultado->fetch_object('Anexo');
    }

    public function    saveAnexo(Anexo    $anexo)
    {
        $sqlGravar    =    "INSERT	INTO	anexos
								(tarefaId,	nome,	arquivo)
								VALUES
								(
												{$anexo->getTarefaId()},
												'{$anexo->getNome()}',
												'{$anexo->getArquivo()}'
								)";
        $this->conn->query($sqlGravar);
    }
    public function    removeAnexo(int    $id)
    {
        $sqlRemover    =    "DELETE	FROM	anexos	WHERE	id	=	{$id}";
        $this->conn->query($sqlRemover);
    }
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
