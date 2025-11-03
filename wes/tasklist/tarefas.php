<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taskist</title>
</head>

<body>
    <h1>Gerenciador de Tarefas</h1>

    <form action="">
        <fieldset>
            <legend>Nova Task</legend>
            <label for="">Tarefa:
                <input type="text" name="nome" />
            </label>
            <input type="submit" value="Cadastrar" />
        </fieldset>
    </form>

    <?php
    $taskList = [];
    if (array_key_exists('nome', $_GET)) {
        $taskList[] = $_GET['nome'];
    }
    ?>

    <table>
        <tr>
            <th>
                Tarefas
            </th>
        </tr>

        <?php foreach ($taskList as $task) : ?>
        <tr>
            <td>
                <?php echo $task; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>


</body>

</html>