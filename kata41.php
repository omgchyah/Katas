<?php

$date1 = '15/05/2024';
$date2 = '15/06/2024';
//Incorrect date
$date3 = '45/15/2024';
//Leap year
$date4 = '29/02/2024';

function verifyDate(string $date): bool
{   
    $dateParts = explode('/', $date);

    $day = (int)$dateParts[0];
    $month = (int)$dateParts[1];
    $year = (int)$dateParts[2];

    return checkdate($month, $day, $year);
}

function remainingDays(string $date1, string $date2): string
{
    // Verify if dates are in the correct format
    if (!verifyDate($date1) || !verifyDate($date2)) {
        return "Date format is incorrect." . PHP_EOL;
    }
    // Change dates to proper format
    $format = 'd/m/Y';
    $date1 = DateTime::createFromFormat($format, $date1);
    $date2 = DateTime::createFromFormat($format, $date2);

    // Get interval of days
    $interval = $date1->diff($date2);
    return "There are " . $interval->days . " days of difference." . PHP_EOL;
}

echo remainingDays($date1, $date4);
echo remainingDays($date1, $date3);




/* function verifyDate(string $date): bool
{   
    $formatIsCorrect = true;

    //Convert to 3 differente variables
    $dateParts = explode('/', $date);

    $day = (int)$dateParts[0];
    $month = (int)$dateParts[1];
    $year = (int)$dateParts[2];

    //Check that number of elements is 3
    if (count($dateParts) !== 3) {
        $formatIsCorrect = false;
    }

    if($day > 32 || $month > 12) {
        $formatIsCorrect = false;
    }

    if($year % 4 === 0 && ($year % 100 !== 0 || $year % 400 === 0)) {
        if($month > 29) {
            $formatIsCorrect = false;
        }
    } else {
        $months31Days = [1, 3, 5, 7, 8, 10, 12];
        $month30Days = [4, 6, 9, 11];
        if(in_array($month, $month30Days) && $day > 30) {
            $formatIsCorrect = false;
        } else if (in_array($month, $months31Days) && $day > 31) {
            $formatIsCorrect = false;
        } else if ($month = 02 && $day > 28) {
            $formatIsCorrect = false;
        }
    }

    return $formatIsCorrect;
}

 */
/* function remainingDays(string $date1, string $date2): string
{
    // Verify if dates are in the correct format
    if (!verifyDate($date1) || !verifyDate($date2)) {
        return "Date format is incorrect." . PHP_EOL;
    }
    // Change dates to proper format
    $format = 'd/m/Y';
    $date1 = DateTime::createFromFormat($format, $date1);
    $date2 = DateTime::createFromFormat($format, $date2);
    // Check if date creation was successful
    if ($date1 === false || $date2 === false) {
        return "Date format is incorrect." . PHP_EOL;
    }
    // Get interval of days
    $interval = $date1->diff($date2);
    return "There are " . $interval->days . " days of difference." . PHP_EOL;
}

echo remainingDays($date1, $date2);
echo remainingDays($date1, $date3);
echo remainingDays($date2, $date4); */



