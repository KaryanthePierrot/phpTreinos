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

    $dados = explode('/', $data);

    $dataDb = "{$dados[2]}-{$dados[1]}-{$dados[0]}";
    return $dataDb;
}

function transDateToView($data, $regiao)
{
    if ($data == '' or $data == "0000-00-00") {
        return "";
    }

    $objeto_data    =    DateTime::createFromFormat('Y-m-d',    $data);
    $resultado    =    '';
    if ($regiao    ==    'EUA') {
        $resultado    =    $objeto_data->format('m/d/Y');
    } else {
        $resultado    =    $objeto_data->format('d/m/Y');
    }
    return $resultado;
}

function transConclusao($concluida){
    if ($concluida == '1') {
        return 'sim';
}
return 'não';
}