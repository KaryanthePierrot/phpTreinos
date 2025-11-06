<?php
include "../bd.php";

$anexo	=	getAnexo($conn,	$_GET['id']);

if	(!	is_array($anexo))	{
				http_response_code(404);
				echo "Anexp não	encontrado.";
				die();
}

delAnexo($conn,	$anexo['id']);
unlink('anexos/'	.	$anexo['arquivo']);
header('Location:	../task.php?id='	.	$anexo['tarefa_id']);
exit();