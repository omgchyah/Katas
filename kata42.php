<?php declare(strict_types=1);

echo "Enter a phrase, please: ";

$text = trim(fgets(STDIN));

$array = explode(' ', $text);

foreach($array as $word) {
   $longestWord = ''; 
    if(strlen($word) > strlen($longestWord)) {
        $longestWord = $word;
    }
}

$longestLength = strlen($longestWord);

$borderLine = str_repeat('#', $longestLength + 4);

echo $borderLine . PHP_EOL;

for($i = 0; $i < count($array); $i++) {
    $wordLength = strlen(($array[$i]));
    $spaces = $longestLength - $wordLength;

    $leftSpaces = str_repeat(' ', intdiv($spaces, 2));
    $rightSpaces = str_repeat(' ', $spaces - intdiv($spaces, 2));

    echo '# ' . $leftSpaces . $array[$i] . $rightSpaces . ' #' . PHP_EOL;
}

echo $borderLine;
