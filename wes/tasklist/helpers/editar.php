<?php
session_start();
include("../config.php");

require "../bd.php";
require "helpers.php";

$showTable	=	false;

$hasErrors	=	false;
$errosValidacoes	=	[];

if (temPost()) {
	// $tarefa	=	[
	// 	'id' => $_POST['id'],
	// 	'nome' =>    $_POST['nome'],
	// 	'descricao' => '',
	// 	'prazo' => '',
	// 	'prioridade' => $_POST['prioridade'],
	// 	'concluida' => 0,
	// ];

	if (array_key_exists('nome', $_POST) && strlen($tarefa['nome'])    >    0) {
		$tarefa->setNome($_POST['nome']);
	} else {
		$hasErrors    =    true;
		$errosValidacoes['nome']    =    'O	nome	da	tarefa	é	obrigatório!';
	}

	if (array_key_exists('descricao',	$_POST)) {
		$tarefa->setDescricao($_POST['descricao']);
	}


	if (
		array_key_exists('prazo',	$_POST)
		&&	strlen($_POST['prazo'])	>	0
	) {
		if (validar_data($_POST['prazo'])) {
			$tarefa->setPrazo(
				transDateToObj($_POST['prazo'])
			);
		} else {
			$tem_erros	=	true;
			$erros_validacao['prazo']	=
				'O	prazo	não	é	uma	data	válida!';
		}
	}

	$tarefa->setPrioridade($_POST['prioridade']);

	if (array_key_exists('concluida',	$_POST)) {
		$tarefa->setConcluida(true);
	}

	if (! $hasErrors) {
		editTask($conn,	$tarefa);
		// if (
		// 	array_key_exists('lembrete',	$_POST)
		// 	&&	$_POST['lembrete']	==	'1'
		// ) {
		// 	$anexos	=	getAnexos($conn,	$tarefa['id']);
		// 	// sendMail($tarefa,	$anexos);
		// }
		header('Location:	../tasklist.php');
		die();
	}
}
$tarefa	=	getTask($conn,	$_GET['id']);

$tarefa['nome']	=	(array_key_exists('nome',	$_POST))	?
	$_POST['nome']	:	$tarefa['nome'];
$tarefa['descricao']	=	(array_key_exists('descricao',	$_POST))	?
	$_POST['descricao']	:	$tarefa['descricao'];
$tarefa['prazo']	=	(array_key_exists('prazo',	$_POST))	?
	$_POST['prazo']	:	$tarefa['prazo'];
$tarefa['prioridade']	=	(array_key_exists('prioridade',	$_POST))
	?
	$_POST['prioridade']	:	$tarefa['prioridade'];
$tarefa['concluida']	=	(array_key_exists('concluida',	$_POST))	?
	$_POST['concluida']	:	$tarefa['concluida'];

require "../templates/template.php";
