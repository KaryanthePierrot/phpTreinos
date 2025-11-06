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

    public function    get(int    $tarefa_id    =    0)
    {
        if ($tarefa_id    >    0) {
            return $this->getTarefa($tarefa_id);
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

    private function    getTarefa(int    $tarefa_id): Tarefa
    {
        $sqlBusca    =    'SELECT	*	FROM	tarefas	WHERE	id	=	'    .    $tarefa_id;
        $resultado    =    $this->conn->query($sqlBusca);
        $tarefa    =    $resultado->fetch_object('Tarefa');
        $tarefa->setAnexos(
            $this->getAnexo($tarefa->getId())
        );
        return $tarefa;
    }

    function    delete(int    $tarefa_id)
    {
        $sqldelete    =    "DELETE	FROM	tarefas	WHERE	id	=	{$tarefa_id}";
        $this->conn->query($sqldelete);
    }

    public function    getAnexos(int    $tarefa_id): array
    {
        $sqlBusca    =
            "SELECT	*	FROM	anexos	WHERE	tarefa_id	=	{$tarefa_id}";
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
								(tarefa_id,	nome,	arquivo)
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
