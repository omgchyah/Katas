<?php declare(strict_types=1);

function findEurekaNumbers(int $n1, int $n2): array
{
    $eurekaNumbers = [];

    for($i = $n1; $i <= $n2; $i++) {
        $total = 0;
        $string_number = strval($i);
        
        for ($index = 0; $index < strlen($string_number); $index++) {
            $digit = intval($string_number[$index]);
            $poweredDigit = pow($digit, $index + 1);
            $total += $poweredDigit;
        }
        if ($total === $i) {
            $eurekaNumbers[] = $i;
        } 
    }

    return $eurekaNumbers;

}

$results = findEurekaNumbers(1, 900);

foreach ($results as $number) {
    echo $number . ", ";

    $string = "Hola";


}
    echo $string[3];
