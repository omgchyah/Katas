<?php declare(strict_types=1);

// Set the internal character encoding to UTF-8
mb_internal_encoding("UTF-8");
header('Content-Type: text/plain; charset=utf-8');

// Ensure the script uses UTF-8 for input and output
ini_set('default_charset', 'UTF-8');

echo "Enter a phrase, please: ";

// Read input from the user using readline()
$text = trim(readline());

// Ensure the text is in UTF-8 encoding
$text = mb_convert_encoding($text, 'UTF-8', 'auto');

echo "You entered: " . $text . PHP_EOL;

// Split the text into words
$array = explode(' ', $text);

// Initialize the longest word variable
$longestWord = ''; 

//Find the longest word
//md reads special characters as one character
foreach($array as $word) {
    if(mb_strlen($word) > mb_strlen($longestWord)) {
        $longestWord = $word;
    }
}

// Length of the longest word
$longestLength = mb_strlen($longestWord);

// Create the border line
$borderLine = str_repeat('#', $longestLength + 4);

echo $borderLine . PHP_EOL;

// Print each word within the border
foreach($array as $word) {

    $wordLength = mb_strlen($word);
    $spaces = $longestLength - $wordLength;

    $leftSpaces = str_repeat(' ', (int) intdiv($spaces, 2));
    $rightSpaces = str_repeat(' ',  (int)  $spaces - intdiv($spaces, 2));

    echo '# ' . $leftSpaces . $word . $rightSpaces . ' #' . PHP_EOL;

}

echo $borderLine;
