<!-- Tabela de tarefas -->
<table id="tabela-tarefas">
    <tr>
        <th class="tabela-titulo">Tarefas</th>
        <th class="tabela-titulo">Descrição</th>
        <th class="tabela-titulo">Prazo</th>
        <th class="tabela-titulo">Prioridade</th>
        <th class="tabela-titulo">Concluída</th>
        <th class="tabela-titulo">Opções</th>
        <th class="tabela-titulo">ID</th>
    </tr>
    <?php foreach ($tarefas as $tarefa) :    ?>
        <tr>

            <td id="tabela-item">
                <a href="./controllers/task.php?id=<?php echo $tarefa->getId(); ?>">
                    <?php echo $tarefa->getNome()    ?>
            </td>
            </a>
            <td id="tabela-item"><?php echo $tarefa->getDescricao()    ?></td>
            <td id="tabela-item"><?php echo    transDateToView($tarefa->getPrazo());    ?></td>
            <td id="tabela-item"><?php echo traduzPrioridade($tarefa->getPrioridade()); ?></td>
            <td id="tabela-item"><?php echo transConclusao($tarefa->getConcluida()); ?></td>
            <td id="tabela-item">
                <a href="helpers/editar.php?id=<?php echo $tarefa->getId(); ?>">Editar</a> ||
                <a href="helpers/remover.php?id=<?php echo $tarefa->getId();    ?>">Remover</a>
            </td>
            <td id="tabela-item"> Tarefa de id <?php echo $tarefa->getId() ?> </td>
        </tr>
    <?php endforeach;    ?>
</table>