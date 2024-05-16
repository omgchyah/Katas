<?php

//It's a square matrix
//Sum of row and columns is the same
//Sum of diagonal numbers is algo the same


$array1 = [2, 7, 6, 9, 5, 1, 4, 3, 8];

$array2 = [3, 7, 6, 9, 5, 1, 4, 3, 8];

function convertMatrix(array $array): array {

    $matrix = [];

    for($i = 0; $i < 3; $i++) {
        $matrix[] = array_slice($array, $i * 3, 3);
    }

     return $matrix;

}

$matrix1 = convertMatrix($array1);
$matrix2 = convertMatrix($array2);

print_r($matrix1);
print_r($matrix2);

function isItMagic(array $matrix): string {

    $nIndex = count($matrix);
    $output = "";

    $diagonal1 = 0;
    $diagonal2 = 0;

    //Suma diagonal
    for($i = 0; $i < $nIndex; $i++) {
        for($j = 0; $j < $nIndex; $j++) {
            $diagonal1 += $matrix[$i][$j];
            $diagonal2 += $matrix[$j][$i];
        }    
    }

    $rowsArray = array_map("array_sum", $matrix);

    $columnsSum = 0;
    $columnsArray = [];

    for($i = 0; $i < $nIndex; $i++) {
        $columnsSum = 0;
        for($j = 0; $j < $nIndex; $j++) {
            $columnsSum += $matrix[$j][$i];
        }
        $columnsArray[] = $columnsSum;
    }
    


    if($diagonal1 == $diagonal2 && $rowsArray === $columnsArray && $diagonal1 == $rowsArray[0] && $diagonal1 == $columnsArray[0]) {
        $output = "It's magic!" . PHP_EOL;
    } else {
        $output = "It's not magic. Sorry!" . PHP_EOL;
    }


    return $output;

}

echo isItMagic($matrix1);

echo isItMagic($matrix2);






?>