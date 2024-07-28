<?php declare(strict_types=1);

echo "Enter a phrase, please: ";

// Read input from the user using readline()
$text = trim(readline());

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
