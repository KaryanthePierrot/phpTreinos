<?php

use function Laravel\Prompts\table;

date_default_timezone_set('America/Sao_Paulo');

echo date("l") . "\n";
echo date("F") . "\n";
echo date("A") . "\n";
echo date("jS") . "\n";
echo date("g") . "\n";
print "<p> hoje é dia " . date('D/M/Y') . "</p>";
print " e agora são " . date('h:i:s');


print "<p> hoje é dia " . date('D/M/Y') . "</p>";

/* a partir daqui é o exemplo do calendário || Capítulo 4 */

// a seguir a função que eu criei para adicionar linhas no calendário
function linha($semana)
{
    $linha = '<tr>';

    for ($i = 0; $i <= 6; $i++) {
        if (array_key_exists($i, $semana)) {
            $linha .= "<td>{$semana[$i]}</td>";
        } else {
            $linha .= "<td></td>";
        }
    }
    $linha .= "</tr>";
    return $linha;
}

// a próxima função é ára desenhar o calendário em questão 
function calendario()
{
    $calendario = '';
    $dia = 1;
    $semana = [];


    while ($dia <= 31) {

        if (count($semana) == 7) {
            $calendario .= linha($semana);
            $semana = [];
        }

        if ($dia == date("d")) {
            array_push($semana, "<strong>$dia</strong>");
        } else {
            array_push($semana, $dia);
        }
        $dia++;
    }



    $calendario .= linha($semana);

    return $calendario;
}

// função de bom dia
function oi()
{
    $msg = "";
    if (date("A") ==  "AM") {
        $msg = "Bom dia!!";
    } else if (date("A") == "PM") {
        $msg = "Boa tarde !!";
    }


    return $msg;
}

?>

<?php echo oi(); ?>

<table border="1">
    <tr>
        <th> Dom </th>
        <th> Seg </th>
        <th> Ter </th>
        <th> Qua </th>
        <th> Qui </th>
        <th> Sex </th>
        <th> Sab </th>
    <tr>
        <?php echo calendario(); ?>
</table>