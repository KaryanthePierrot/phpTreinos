<?php 
date_default_timezone_set("America/Sao_Paulo");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Dia <?php echo date('d/m/Y'); ?></title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <h1>Estamos em <?php echo date('Y'); ?> e hoje é dia <?php echo date('d/m'); ?> </h1>

    <p>
        Esta pagina foi gerada às <?php echo date('H'); ?> horas e <?php echo date('i'); ?> minutos  
    </p>
</body>
</html>