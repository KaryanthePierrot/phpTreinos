
    <!-- Formulário -->
    <div class="form">
        <form style="flex-direction: column; justify-content: center;"
            action="tasklist.php" method="GET">
            <fieldset>
                <legend>Nova Task</legend>
                <label>Tarefa:
                    <input type="text" name="nome" />
                </label>
                <br>
                <label>
                    Descrição (Opicional)
                    <textarea name="descricao" id="desc"></textarea>
                </label>

                <label>
                    Prazo (Opcional):
                    <input type="text" name="prazo" />
                </label>

                <fieldset>
                    <legend>Prioridade:</legend>
                    <label>
                        <input type="radio" name="prioridade" value="1"
                            checked />Baixa
                        <input type="radio" name="prioridade" value="2" />
                        Média
                        <input type="radio" name="prioridade" value="3" />
                        Alta
                    </label>
                </fieldset>
                <label>
                    Tarefa concluída:
                    <input type="checkbox" name="concluida" value="1" />
                </label>

                <input type="submit" value="Cadastrar" id="form-botao" />
                <input type="button" value="Limpar" id="form-botao" />
                
            </fieldset>
        </form>
    </div>