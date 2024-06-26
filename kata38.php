<?php declare(strict_types= 1);

function verifyNumber($number): bool {
    if($number >= 0) {
        return true;
    } else {
        throw new InvalidArgumentException("Only natural numbers are valid.");
    }
}

function powerTwo(int $number) : int {

    if(!verifyNumber($number)) {
        throw new InvalidArgumentException("Cannot perform this task.");
    }

    return pow($number, 2);
}

function powerThree(int $number) : int {

    if(!verifyNumber($number)) {
        throw new InvalidArgumentException("Cannot perform this task.");
    }

    return pow($number, 3);
}

function factorial(int $number): int {

    if(!verifyNumber($number)) {
        throw new InvalidArgumentException("Cannot perform this task.");
    }

    if ($number == 0) {
        return 1;
    }
    
    $result = 1;
    
    for($i = 1; $i <= $number; $i++) {
           $result *= $i;
    }

    return $result;
}

$number = 3;

$file = "calculs_" . $number . ".txt";

$text = "Número: " . $number . ". Quadrat: " . powerTwo($number) . ". Cub: " . powerThree($number) . ". Factorial : " . factorial($number) . ".";

//Open to write only
$gestor = fopen($file,"w");

if (is_writable($file)) {

    //'a' Open for writing only; place the file pointer at the end of the file. If the file does not exist, attempt to create it.
    if(!$gestor = fopen($file,"a")) {
        echo "Cannot open file ($file)";
    exit;
    }

    if (fwrite($gestor, $text) === FALSE) {
        echo "Cannot write to file ($file)";
        exit;
    }

    echo "Success, wrote ($text) to file ($file)";

    fclose($gestor);

} else {
    echo "The file $file is not writable";
}


?>