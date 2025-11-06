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
    <?php foreach ($lista_tarefas as $tarefa) :    ?>
        <tr>

            <td id="tabela-item">
                <a href="./controllers/task.php?id=<?php echo $tarefa['id']; ?>">
                    <?php echo $tarefa['nome']    ?>
            </td>
            </a>
            <td id="tabela-item"><?php echo $tarefa['descricao']    ?></td>
            <td id="tabela-item"><?php echo    transDateToView($tarefa['prazo']);    ?></td>
            <td id="tabela-item"><?php echo traduzPrioridade($tarefa['prioridade']); ?></td>
            <td id="tabela-item"><?php echo transConclusao($tarefa['concluida']); ?></td>
            <td id="tabela-item">
                <a href="helpers/editar.php?id=<?php echo $tarefa['id']; ?>">Editar</a> ||
                <a href="helpers/remover.php?id=<?php echo $tarefa['id'];    ?>">Remover</a>
            </td>
            <td id="tabela-item"> Tarefa de id <?php echo $tarefa['id'] ?> </td>
        </tr>
    <?php endforeach;    ?>
</table>