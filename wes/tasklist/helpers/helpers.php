<?php

use PHPMailer\PHPMailer\PHPMailer;

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

function    sendMail($tarefa,    $anexos = [])
{

    require '/xampp/htdocs/phpTreinos/wes/tasklist/librarys/PHPMailer/inc.php';
    $corpo    =    prepareMail($tarefa,    $anexos);
    $email    =    new    PHPMailer();
    $email->isSMTP();
    $email->Host    =    "smtp.gmail.com";
    $email->Port    =    587;
    $email->SMTPSecure    =    'tls';
    $email->SMTPAuth    =    true;
    $email->Username    =    "fandeanimes13@gmail.com";
    $email->Password    =    "amoreparaosfracos";
    $email->setFrom("fandeanimes13@gmail.com",    "Avisador	de	Tarefas");
    $email->addAddress(EMAIL_NOTIFICACAO);
    $email->Subject    =    "Aviso	de	tarefa:	{$tarefa['nome']}";
    $email->msgHTML($corpo);
    foreach ($anexos as $anexo) {
        $email->addAttachment("anexos/{$anexo['arquivo']}");
    }
    $email->send();
    		if	(!	$email->send())	{
						saveLog($email->ErrorInfo);		//	salvar	o	erro	em	um	arquivo	de	log
				}
}

function prepareMail($tarefa, $anexos)
{

    ob_start();
    include "../templates/templateMail.php";

    $corpo = ob_get_contents();

    ob_end_clean();
    return $corpo;
}

function	saveLog($mensagem)
{
				$datahora	=	date("Y-m-d	H:i:s");
				$mensagem	=	"{$datahora}	{$mensagem}\n";
				file_put_contents("mensagens.log",	$mensagem,	FILE_APPEND);
}
