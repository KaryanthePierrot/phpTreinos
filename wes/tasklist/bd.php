<?php

use Tarefas\Models\Tarefa;


$conn = mysqli_connect(
    BDSERVER,
    BDUSER,
    BDPASS,
    BD
);


if (mysqli_connect_errno()) {
    echo 'Problema na conexão com o banco de dados. Erro: ';
    echo mysqli_connect_error();
    die();
}