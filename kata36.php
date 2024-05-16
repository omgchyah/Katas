<?php declare(strict_types=1);

//Contar del 1 al 10

for ($i = 1; $i <= 10; $i++) {
    echo $i . "<br>";
}

$i = 1;

while($i <= 10) {
    echo $i . "<br>";
}

function sumar10($i): string {

    $llego10 = true;
    $resultado = "";

    if($i <= 10) {
        $llego10 = false;
        $resultado += $i . "<br>";
        $i++;
    } $llego10 = true;

    return $resultado;
}

echo $resultado;




?>