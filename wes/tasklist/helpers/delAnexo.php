<?php

include("../config.php");
include "../bd.php";

$anexo	=	getAnexo($conn,	$_GET['id']);
$tarefaId = $anexo['tarefaId'];


if (! is_array($anexo)) {
	http_response_code(404);
	echo "Anexp não	encontrado.";
	die(header("Location:	../controllers/task.php?id={$tarefaID}"));
}

delAnexo($conn,	$anexo['id']);
unlink('anexos/'	.	$anexo['arquivo']);
header("Location:	../controllers/task.php?id={$tarefaId}");
exit();
