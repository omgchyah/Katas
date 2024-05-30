<?php declare(strict_types= 1);

$fileName = "loveIsAwful.txt";

/*
En sistemas en los que se diferencia entre archivos binarios y de texto (esto es, Windows) el fichero debe ser abierto con 'b' incluida en el parámetro modo de fopen(). 
*/

$gestor = fopen($fileName, "rb");
$contenido = fread($gestor, filesize($fileName));

//Can also use file_get_contents
//$contenido = file_get_contents($fileName);

//Split the string into an array of words
$arrayText = explode(" ", $contenido);

// Split the string into an array of words using space as the delimiter
//$arrayText = preg_split('/\s+/', $contenido);

function findWordsVowel($arrayText): array {
    $wordsWithVowel = [];
    $vowels = ["a", "e", "i", "o", "u", "A", "E", "I", "O", "U"];
    foreach($arrayText as $word) {
        $hasVowel = false;
        for($i = 0; $i < strlen($word); $i++) {
            if (in_array($word[$i], $vowels)) {
                $hasVowel = true;
            }
        }
        if($hasVowel) {
            $wordsWithVowel[] = $word;
        }
    }
    return $wordsWithVowel;
}


function findWordsWithT($arrayText): array {
    $wordsWithT = [];
    $letter = ["t", "T"];
    foreach ($arrayText as $word) {
        if (in_array($word[0], $letter)) {
            $wordsWithT[] = $word;
        }
    }
    return $wordsWithT;
}

print_r(findWordsVowel($arrayText));
print_r(findWordsWithT($arrayText));

fclose($gestor);