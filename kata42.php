<?php declare(strict_types=1);

// Set the internal character encoding to UTF-8
mb_internal_encoding("UTF-8");

// Set the output encoding to UTF-8
mb_http_output("UTF-8");

echo "Enter a phrase, please: ";

$text = trim(fgets(STDIN));

$array = explode(' ', $text);

$longestWord = ''; 

//Find the longest word
foreach($array as $word) {
    if(mb_strlen($word) > mb_strlen($longestWord)) {
        $longestWord = $word;
    }
}

$longestLength = mb_strlen($longestWord);

$borderLine = str_repeat('#', $longestLength + 4);

echo $borderLine . PHP_EOL;

for($i = 0; $i < count($array); $i++) {

    $wordLength = mb_strlen($array[$i]);

    $spaces = $longestLength - $wordLength;

    $leftSpaces = str_repeat(' ', (int) intdiv($spaces, 2));

    $rightSpaces = str_repeat(' ',  (int)  $spaces - intdiv($spaces, 2));

    echo '# ' . $leftSpaces . $array[$i] . $rightSpaces . ' #' . PHP_EOL;

}

echo $borderLine;
