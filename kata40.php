<?php declare(strict_types=1);

function checkParentheses1($formula): string {
    //Convert to array
    $array = str_split($formula, 1);
    $arrayBeg = [];
    $arrayEnd = [];
    foreach($array as $word) {
        if($word === "(") {
            $arrayBeg[] = $word;
        } else if ($word === ")") {
            $arrayEnd[] = $word;
        }
    }
    if(count($arrayBeg) == count($arrayEnd)) {
        return "Es correcta!" . PHP_EOL;
    } else {
        return "Es incorrecta!" . PHP_EOL;
    }
}

function checkParentheses2($formula): string {
    $numBeg = substr_count($formula, "(");
    $numEnd = substr_count($formula, ")");

    if($numBeg == $numEnd) {
        return "Es correcta!" . PHP_EOL;
    } else {
        return "Es incorrecta!" . PHP_EOL;
    }
}
function checkParentheses3($formula): string {
    //$formulaString = "$formula";
   preg_match_all('/[()]/', $formula, $matches);
   $parentheses = $matches[0];

   $remaining = 0;
   foreach($parentheses as $parenthesis) {
    if($parenthesis == "(") {
        $remaining++;
    } else if($parenthesis == ")") {
        $remaining--;
    }
   }

   if($remaining == 0) {
    return "Es correcta!" . PHP_EOL;
   } else {
    return "Es incorrecta!";
   }
} 


$formula1 = "(3 + 4) * 2";
$formula2 = "(5 + 3) * (3 - 1)";
$formula3 = "(5 + 3 * (3 - 1)";

echo checkParentheses1($formula1);
echo checkParentheses1($formula2);
echo checkParentheses1($formula3);

echo checkParentheses2($formula1);
echo checkParentheses2($formula2);
echo checkParentheses2($formula3);

echo checkParentheses3($formula1);
echo checkParentheses3($formula2);
echo checkParentheses3($formula3);







