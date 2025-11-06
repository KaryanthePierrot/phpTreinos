<?php

use PHPMailer\PHPMailer\PHPMailer;
// traduções
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

function    transDateToObj($data)
{
    if ($data    ==    "") {
        return "";
    }
    $dados    =    explode("/",    $data);
    if (count($dados)    !=    3) {
        return $data;
    }
    return    DateTime::createFromFormat('d/m/Y',    $data);
}



//
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

// anexos

function tratarAnexo($anexo)
{
    $padrao = '/^.+(\.pdf|\.zip)$/';

    $resultado = preg_match($padrao, $anexo['name']);

    if ($resultado == 0) {
        return false;
    }

    move_uploaded_file($anexo['tmp_name'], "anexos/{$anexo['name']}");
    return true;
}

// // Emails
// function	sendMail(Tarefa	$tarefa)
// {
// 				include "bibliotecas/PHPMailer/inc.php";
// 				$corpo	=	prepareMail($tarefa);
// 				$email	=	new	PHPMailer();
// 				$email->isSMTP();
// 				$email->Host	=	"smtp.gmail.com";
// 				$email->Port	=	587;
// 				$email->SMTPSecure	=	'tls';
// 				$email->SMTPAuth	=	true;
// 				$email->Username	=	"seuemail@dominio.com";
// 				$email->Password	=	"senhasecreta";
// 				$email->setFrom(
// 								"seuemail@dominio.com",
// 								"Avisador	de	Tarefas"
// 				);
// 				$email->addAddress(EMAIL_NOTIFICACAO);
// 				$email->Subject	=	"Aviso	de	tarefa:	{$tarefa->getNome()}";
// 				$email->msgHTML($corpo);
// 				foreach	($tafera->getAnexos()	as $anexo)	{
// 								$email->addAttachment("anexos/{$anexo->getArquivo()}");
// 				}
// 				$email->send();
// }

// function prepareMail(Tarefa $tarefa)
// {

//     ob_start();
//     include "../templates/templateMail.php";

//     $corpo = ob_get_contents();

//     ob_end_clean();
//     return $corpo;
// }

// function	saveLog($mensagem)
// {
// 				$datahora	=	date("Y-m-d	H:i:s");
// 				$mensagem	=	"{$datahora}	{$mensagem}\n";
// 				file_put_contents("mensagens.log",	$mensagem,	FILE_APPEND);
// }
