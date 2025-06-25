<?php declare(strict_types=1);

function isIsogram(string $string) {

    return strlen($string) == count(array_unique(str_split(strtolower($string))));

}

$string = readline("Write a word:");

echo isIsogram($string) ? "True" : "False";