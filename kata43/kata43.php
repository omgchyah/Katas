<?php declare(strict_types=1);

require 'StudyPlan.php';
require 'VacationPlan.php';

$option = 0;

do {

    echo "¡Hola! Por favor, seleccione una opción." . PHP_EOL .
    "1. Crear plan vacacional." . PHP_EOL .
    "2. Anular plan vacacional." . PHP_EOL .
    "3. Planificar entrega IT Academy." . PHP_EOL .
    "4. Planificar reentrega IT Academy." . PHP_EOL .
    "5. Revisar agenda de día." . PHP_EOL .
    "0. Salir." . PHP_EOL .

    $option = (int)(readline());

    switch($option) {
        case 1 & 3:
            echo 
    }



} while ($opcion != 0);


function checkDate(string $dateInput)
{
    $date = DateTime::createFromFormat('d-m-Y', $dateInput);

    if ($date === false) {
        throw new Exception("Formato de fecha no válido. Use (dd-mm-aaaa)." . PHP_EOL);
    }

    $plan->setDate($date);

    if (!$plan->isDateAvalaible($date)) {
        echo 'Lo siento. Fecha no disponible.' . PHP_EOL;
        exit;
    }
}

function createVacationPlan(int $opcion)
{
    echo 'Por favor, ingrese la fecha de su plan en formato (dd-mm-aaaa): ' . PHP_EOL;
    $dateInput = trim(readline());

    checkDate($dateInput);

    echo 'Ingrese el nombre del plan: ' . PHP_EOL;
        $name = trim(readline());
        $plan->setName($name);

        echo 'Ingrese el número de Sprint (1-5): ' . PHP_EOL;
        $sprintNumber = (int)trim(readline());

        if (!in_array($sprintNumber, range(1, 5))) {
            throw new Exception("Número de Sprint no válido. Use un número entre 1 y 5." . PHP_EOL);
        }

        $sprint = Sprint::from($sprintNumber);
        $plan->setSprint($sprint);

        echo 'Ingrese el enlace de GitHub: ' . PHP_EOL;
        $gitHubLink = trim(readline());
        $plan->setGitHubLink($gitHubLink);

        echo 'Si lo desea, agregué alguna nota: ' . PHP_EOL;
        $notes = trim(readline());
        $plan->setNotes($notes);

        if ($plan->create()) {
            echo "¡Plan creado exitosamente!" . PHP_EOL;
        } else {
            echo "Error al crear el plan." . PHP_EOL;
        }
}

function createStudyPlan(int $option)
{
    echo 'Por favor, ingrese la fecha de su plan en formato (dd-mm-aaaa): ' . PHP_EOL;
    $dateInput = trim(readline());

    checkDate($dateInput);

    echo 'Ingrese el nombre del plan: ' . PHP_EOL;
        $name = trim(readline());
        $plan->setName($name);

        echo 'Ingrese la ubicación del plan: ' . PHP_EOL;
        $location = trim(readline());
        $plan->setLocation($location);

        echo 'Ingrese el tipo del plan (Restaurant, Sports, Cultural, Visit): ' . PHP_EOL;
        $typeInput = ucfirst(trim(readline())); 

        if (!in_array($typeInput, array_column(Type::cases(), 'value'))) {
            throw new Exception("Tipo de plan no válido. Use 'Restaurant', 'Sports', 'Cultural', o 'Visit'." . PHP_EOL);
        }

        $type = Type::from($typeInput);
        $plan->setType($type);

        if ($plan->create()) {
            echo "¡Plan creado exitosamente!" . PHP_EOL;
        } else {
            echo "Error al crear el plan." . PHP_EOL;
        }

}
