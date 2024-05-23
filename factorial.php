<?php

function factorial(int $number): int {

    $result = 1;


    if ($number == 0) {
        $result = 1;
    }
    
    for($i = 1; $i <= $number; $i++) {
           $result *= $i;
    }

    return $result;
}

$number = 3;

echo factorial($number);
