<!-- <h1>Tarefa: <?php echo $tarefa->getNome();    ?></h1>
<p>
    <strong>Concluída:</strong>
    <?php echo    transConclusao($tarefa->getConcluida());    ?>
</p>
<p>
    <strong>Descrição:</strong>
    <?php echo    nl2br($tarefa->getDescricao());    ?>
</p>
<p>
    <strong>Prazo:</strong>
    <?php echo    transDateToView($tarefa->getPrazo());    ?>
</p>
<p>
    <strong>Prioridade:</strong>
    <?php echo    traduzPrioridade($tarefa->getPrioridade());    ?>
</p>
<?php if (count($tarefa->getAnexos())    >    0) :    ?>
    <p><strong>Atenção!</strong> Esta tarefa contém anexos!</p>
<?php endif;    ?> -->