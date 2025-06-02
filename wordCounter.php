<?php declare(strict_types=1);

//Create a word counter

function findMostRepeatedWord(): void {

    $filename = readline('Enter the name of the file with extension: ');

    $fileString = strtolower(file_get_contents($filename));

    $wordsArray = [];

    $wordsArray = explode(" ", $fileString);

    $uniqueWords = [];
    foreach ($wordsArray as $word) {
        if (!in_array($word, $uniqueWords)) {
            $uniqueWords[] = $word;
        }
    }

    $maxCount = 0;
    $maxWord = '';

    foreach ($uniqueWords as $word) {
        $count = 0;
        foreach ($wordsArray as $w) {
            if ($w === $word) {
                $count ++;
            }
        }

        if ($count > $maxCount) {
        $maxCount = $count;
        $maxWord = $word;
        }
    }

    echo "The most repeated word is '{$maxWord}' ({$maxCount} times)";

}

findMostRepeatedWord();







