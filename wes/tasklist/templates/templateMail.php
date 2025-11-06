<h1>Tarefa: <?php echo $tarefa['nome'];    ?></h1>
<p>
    <strong>Concluída:</strong>
    <?php echo transConclusao($tarefa['concluida']);    ?>
</p>
<p>
    <strong>Descrição:</strong>
    <?php echo nl2br($tarefa['descricao']);    ?>
</p>
<p>
    <strong>Prazo:</strong>
    <?php echo transDateToView($tarefa['prazo']);    ?>
</p>
<p>
    <strong>Prioridade:</strong>
    <?php echo traduzPrioridade($tarefa['prioridade']);    ?>
</p>
<?php if (count($anexos)    >    0) :    ?>
    <p><strong>Atenção!</strong> Esta tarefa contém anexos!</p>
<?php endif;    ?>

<p>
    Tenha um bom dia!
</p>