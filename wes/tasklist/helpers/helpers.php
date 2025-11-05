<?php

function traduzPrioridade($code)
{
    $prioridade = '';
    switch ($code) {
        case 1:
            $prioridade = 'Baixa';
            break;
        case 2:
            $prioridade = 'Média';
            break;
        case 3:
            $prioridade = 'Alta';
            break;
    }
    return $prioridade;
}

function transDateToDb($data)
{
    if ($data == '') {
        return '';
    }

    $partes = explode('/', $data);

    if (count($partes)    !=    3) {
        return $data;
    }
    $objeto_data    =    DateTime::createFromFormat('d/m/Y',    $data);
    return $objeto_data->format('Y-m-d');
}

function transDateToView($data)
{
    if ($data == '' or $data == "0000-00-00") {
        return "";
    }

    $partes    =    explode("-",    $data);
    //	Novo	retorno	da	data	original
    if (count($partes)    !=    3) {
        return $data;
    }

    $objeto_data    =    DateTime::createFromFormat('Y-m-d',    $data);
    $resultado    = $objeto_data->format('d/m/Y');
    return $resultado;
}

function transConclusao($concluida)
{
    if ($concluida == '1') {
        return 'sim';
    }
    return 'não';
}


// $showTable = true;
$hasErrors = false;
$errosValidacoes = [];


function temPost()
{
    return (count($_POST) > 0);
}

function    validar_data($data)
{
    $padrao    =    '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
    $resultado    =    preg_match($padrao,    $data);

    if ($resultado    ==    0) {
        return false;
    }
    $dados    =    explode('/',    $data);
    $dia    =    $dados[0];
    $mes    =    $dados[1];
    $ano    =    $dados[2];
    return    checkdate($mes,    $dia,    $ano);
}
