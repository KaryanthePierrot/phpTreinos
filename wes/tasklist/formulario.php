<!-- Formulário -->
<div class="form" >
    <form style="flex-direction: column; justify-content: center;"
        method="POST">

        <input type="hidden" name="id"
            value="<?php echo $tarefa['id'];    ?>" />

        <fieldset>
            <legend>Nova Task</legend>

            <label>Tarefa:
                <?php if (
                    $hasErrors
                    &&    array_key_exists('nome',    $errosValidacoes)
                ) :    ?>
                    <span class="erro">
                        <p style='color:red; font-size: 1px;'> <?php echo   $errosValidacoes['nome'];     ?></p>
                    </span>
                <?php endif;    ?>
                <input type="text" name="nome"
                    value="<?php echo    $tarefa['nome'];    ?>" /> </label>

            <br>
            <label>
                Descrição (Opicional)
                <textarea name="descricao">
                    <?php echo $tarefa['descricao']; ?>
                </textarea>
            </label>

            <label>
                Prazo (Opcional):
                <?php
                if ( $hasErrors &&    array_key_exists('prazo',    $errosValidacoes)
                ) :    ?>
                    <span class="erro">
                        <?php echo    $errosValidacoes['prazo'];    ?>
                    </span>
                <?php endif;    ?>
                <input type="text" name="prazo" value="<?php echo transDateToView($tarefa['prazo']);    ?>" />
            </label>


            <fieldset>
                <legend>Prioridade:</legend>
                <label>
                    <input type="radio" name="prioridade" value="1"
                        <?php echo ($tarefa['prioridade']    ==    1)
                            ?    'checked'
                            :    '';
                        ?> /> Baixa
                    <input type="radio" name="prioridade" value="2"
                        <?php echo ($tarefa['prioridade']    ==    2)
                            ?    'checked'
                            :    '';
                        ?> /> Média
                    <input type="radio" name="prioridade" value="3"
                        <?php echo ($tarefa['prioridade']    ==    3)
                            ?    'checked'
                            :    '';
                        ?> /> Alta


                </label>
            </fieldset>
            <label>
                Tarefa concluída:
                <input type="checkbox" name="concluida" value="1"
                    <?php echo ($tarefa['concluida']    ==    1)
                        ?    'checked'
                        :    '';
                    ?> />
            </label>

            <input type="submit" value="Cadastrar" id="form-botao" value="
<?php echo ($tarefa['id'] > 0) ? 'Atualizar' : 'Cadastrar';    ?>	" />
            <button  value="Limpar" id="form-botao" > <a href="helpers/limpaLista.php" style="text-decoration:none; color: black;">Limpar</a></button>

        </fieldset>
    </form>
</div>