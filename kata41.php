<?php

$date1 = '15/05/2024';
$date2 = '15/06/2024';
$date3 = '45/15/2024';
//Leap year
$date4 = '29/02/2024';

function verifyDate(string $date): bool
{   
    $formatIsCorrect = true;
    //Convert to 3 differente variables
    $separator = '/';
    $dateParts = explode($separator, $date);

    $day = (int)$dateParts[0];
    $month = (int)$dateParts[1];
    $year = (int)$dateParts[2];

    if (count($dateParts) !== 3) {
        $formatIsCorrect = false;
    }

    if($day > 32 || $month > 12) {
        $formatIsCorrect = false;
    }

    //Verify if it's leap year
    $isLeapYear = false;
    if($year % 4 === 0 && ($year % 100 !== 0 || $year % 400 === 0)) {
        $isLeapYear = true;
        if($month > 29) {
            $formatIsCorrect = false;
        }
    }
    //Verification for non-leap years
    $months31Days = [1, 3, 5, 7, 8, 10, 12];
    $month30Days = [4, 6, 9, 11];
    if($isLeapYear = false) {
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
echo remainingDays($date2, $date4);

//Luego descubrí que existe la función checkdate
function verifyDate2(string $date): bool
{   
    $separator = '/';
    $dateParts = explode($separator, $date);

    $day = (int)$dateParts[0];
    $month = (int)$dateParts[1];
    $year = (int)$dateParts[2];

    if (!checkdate($month, $day, $year)) {
        return false;
    }
    return true;
}

function remainingDays2(string $date1, string $date2): string
{
    // Verify if dates are in the correct format
    if (!verifyDate2($date1) || !verifyDate2($date2)) {
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

echo remainingDays2($date1, $date4);
echo remainingDays2($date1, $date3);

