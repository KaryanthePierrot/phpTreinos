<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task</title>

    <link rel="stylesheet" href="/phpTreinos/wes/tasklist/css/cssTag.css">
    <link rel="stylesheet" href="/phpTreinos/wes/tasklist/css/cssClass.css">
    <link rel="stylesheet" href="/phpTreinos/wes/tasklist/css/cssId.css">

</head>

<body>
    <div class="principal">
        <h1> Tarefa: <?php echo $tarefa['nome']; ?></h1>
        <button>
            <a href="../tasklist.php">
                Voltar para a página de tarefas
            </a>
        </button>

        <p>
            <strong>Concluida</strong>
            <?php echo transConclusao($tarefa['concluida']); ?>
        </p>

        <p>
            <strong>Descrição</strong>
            <?php echo nl2br($tarefa['descricao']); ?>
        </p>

        <p>
            <strong>Prazo</strong>
            <?php echo transDateToView($tarefa['prazo']); ?>
        </p>

        <p>
            <strong>Prioridade</strong>
            <?php echo traduzPrioridade($tarefa['prioridade']); ?>
        </p>

        <!-- Lista dos anexos vem aqui -->
        <h2>Anexos</h2>

        <?php if (count($anexos)    >    0) :    ?>
            <table>
                <tr>
                    <th>Arquivo</th>
                    <th>Opções</th>
                </tr>
                <?php foreach ($anexos as $anexo) :    ?>
                    <tr>
                        <td><?php echo $anexo['nome'];    ?></td>
                        <td>
                            <a
                                href="anexos/<?php echo    $anexo['arquivo'];    ?>">
                                Download
                            </a>
                            <a href="../helpers/delAnexo.php?id=<?php echo $anexo['id'] ?>">
                                Remover
                            </a>
                        </td>
                    </tr>
                <?php endforeach;    ?>
            </table>
        <?php else :    ?>
            <p>Não há anexos para esta tarefa.</p>
        <?php endif;    ?>

        <!-- formulário para novo anexo -->
        <form action="" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Novo anexo</legend>

                <input type="hidden" name="tarefaId" value="<?php echo $tarefa['id']; ?>" />

                <label>
                    <?php if ($hasErrors && array_key_exists('anexo', $errosValidacoes)): ?>
                        <span class="erro">
                            <?php echo $errosValidacoes['anexo']; ?>
                        </span>
                    <?php endif; ?>
                    <input type="file" name="anexo" id="anexo">
                </label>

                <input type="submit" value="Cadastrar" />
            </fieldset>
        </form>

    </div>
</body>

</html>