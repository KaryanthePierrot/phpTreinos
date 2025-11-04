<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taskist</title>
    <link rel="stylesheet" href="css/cssTag.css">
    <link rel="stylesheet" href="css/cssClass.css">
    <link rel="stylesheet" href="css/cssId.css">
</head>

<body>
    <div class="titulo">
        <h1 class="titulo-texto">Gerenciador de Tarefas</h1>
    </div>

    <div class="form">
        <form action="">
            <fieldset>
                <legend>Nova Task</legend>
                <label for="">Tarefa:
                    <input type="text" name="nome" />
                </label>
                <input type="submit" value="Cadastrar" id="form-botao" />
            </fieldset>
        </form>
    </div>

    <?php
    
    if (array_key_exists('nome', $_GET) && $_GET['nome'] != '') {
        $_SESSION['lista_tarefas'][] = $_GET['nome'];
    }
    $lista_tarefas = [];

    if (array_key_exists('lista_tarefas', $_SESSION)) {
        $lista_tarefas = $_SESSION['lista_tarefas'];
    }
    ?>
    <table id="tabela-tarefas">
        <tr>
            <th id="tabela-titulo">Tarefas</th>
        </tr>
        <?php foreach ($lista_tarefas as $tarefa) :    ?>
            <tr>
                <td id="tabela-item"><?php echo $tarefa;    ?></td>
            </tr>
        <?php endforeach;    ?>
    </table>


</body>

</html>