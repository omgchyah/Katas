<?php

//It's a square matrix
//Sum of row and columns is the same
//Sum of diagonal numbers is algo the same

    /*[0][0], [0][1], [0][2]
      [1][0], [1][1], [1][2]
      [2][0], [2][1], [2][2]
    */

//La suma de [0][0], [1][1], [2][2] == [0][2], [1][1], [2][0]
    


$array1 = [2, 7, 6, 9, 5, 1, 4, 3, 8];

$array2 = [3, 7, 6, 9, 5, 1, 4, 3, 8];

function convertToMatrix(array $array): array {

    $matrix = [];

    //Creating a matrix with array_slice
    //First row index 0, length 3 [0, 1, 2]
        
    for($i = 0; $i < 3; $i++) {
        $matrix[] = array_slice($array, $i * 3, 3);
    }

     return $matrix;

}

$matrix1 = convertToMatrix($array1);
$matrix2 = convertToMatrix($array2);

//print_r($matrix1);
//print_r($matrix2);



function isItMagic(array $matrix): string {

    $nIndex = count($matrix);
    $output = "";

    $diagonal1 = 0;
    $diagonal2 = 0;

    //Suma diagonal
    for($i = 0; $i < $nIndex; $i++) {   
        $diagonal1 += $matrix[$i][$i];
        $diagonal2 += $matrix[$i][$nIndex - $i - 1];
    }

    $rowsArray = array_map("array_sum", $matrix);

    $columnsArray = [];

    for($i = 0; $i < $nIndex; $i++) {
        $columnsSum = 0;
        for($j = 0; $j < $nIndex; $j++) {
            $columnsSum += $matrix[$j][$i];
        }
        $columnsArray[] = $columnsSum;
    }

    /*[0][0], [0][1], [0][2]
      [1][0], [1][1], [1][2]
      [2][0], [2][1], [2][2]
    */
    


    
    if($diagonal1 == $diagonal2 && $rowsArray === $columnsArray && $diagonal1 == $rowsArray[0] && $diagonal2 == $columnsArray[0]) {
        $output = "It's magic!" . PHP_EOL;
    } else {
        $output = "It's not magic. Sorry!" . PHP_EOL;
    }


    return $output;

}

echo isItMagic($matrix1);

echo isItMagic($matrix2);




