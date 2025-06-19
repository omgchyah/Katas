<?php declare(strict_types=1);

function guessRandomNumber() {

    $numberGuesses = 3;

    $randomNumber = rand(1, 10);

    $userNumber = readline("Hello! Please input a number between 1 and 10:\n");

    while ($userNumber != $randomNumber && $numberGuesses > 0) {
        if ($numberGuesses > 1) {
            $numberGuesses--;
            echo "Sorry. You guessed the wrong number. Try again you have $numberGuesses guesses left.\n";
            $userNumber = readline("Input a new number:\n");
        } else {
            echo "Sorry. You have no more guesses left. The random number was $randomNumber.";
            break;
        }
    }

    if ($userNumber == $randomNumber) {
        echo "Congratulations. You have guessed the number correctly with " . $numberGuesses . " guesses left.";
    }

}

function guessRandomNumber2(): string {

    $randomNumber = rand(1,10);
    $numberGuesses = 3;
    $answer = "";

    $userNumber = readline("Input a number between 1 and 10: \n");

    while ($numberGuesses > 1 && $userNumber != $randomNumber) {
        $numberGuesses--;
        $userNumber = readline("Sorry. You have $numberGuesses guesses left. Try again: \n");
    }

    if ($userNumber == $randomNumber) {
        $answer = "Congratulations! You guessed the right number with $numberGuesses guesses left.";
    } else {
        $answer = "Sorry. You have no more guesses left. The random number was $randomNumber.";
    }

    return $answer;
}

// guessRandomNumber();

echo guessRandomNumber2();