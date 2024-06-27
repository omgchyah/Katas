<?php

$date1 = '15/05/2024';
$date2 = '15/06/2024';
$date3 = '45/15/2024';

function verifyDate(string $date): string
{
    $separator = '/';

    $dateParts = explode($separator, $date);

    $day = (int)$dateParts[0];
    $month = (int)$dateParts[1];
    $year = (int)$dateParts[2];

    $months31Days = [1, 3, 5, 7, 8, 10, 12];
    $month30Days = [4, 6, 9, 11];

    $message = "Format is correct.";

    $leapYear = false;


    if($year % 4 = 0){
        if($month > 29) {
            $message = "Error";
        }
    }

    if(in_array($month, $month30Days) && $day > 30) {
        $message = "Error" . PHP_EOL;
    } else if (in_array($month, $months31Days) && $day > 31) {
        $message = "Error" . PHP_EOL;
    } else if ($month = 02 && $day > 28){
        $message = "Error" . PHP_EOL;
    }
    return $message;
}

function remainingDays(string $date1, string $date2)
{
    $format = "dd/mm/YYYY";

    $date1 = DateTime::createFromFormat($format, $date1);
    $date2 = DateTime::createFromFormat($format, $date2);

    $interval = $date1->diff($date2);

    return $interval->days . PHP_EOL;

}


echo verifyDate($date1);
echo verifyDate($date3);

echo remainingDays($date1, $date2);

echo remainingDays($date1, $date3);

