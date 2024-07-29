<?php declare(strict_types=1);

require 'StudyPlan.php';
require 'VacationPlan.php';

$option = 0;

do {

    echo "¡Hola! Por favor, seleccione una opción: " . PHP_EOL .
    "1. Crear plan vacacional." . PHP_EOL .
    "2. Anular plan vacacional." . PHP_EOL .
    "3. Planificar entrega IT Academy." . PHP_EOL .
    "4. Planificar reentrega IT Academy." . PHP_EOL .
    "5. Revisar agenda de día." . PHP_EOL .
    "0. Salir." . PHP_EOL;

    $option = (int)(readline());

    switch($option) {
        case 1:
            createVacationPlan();
            break;
        case 2:
            cancelVacationPlan();
            break;
        case 3:
            createStudyPlan();
            break;
        case 4:
            changeDateStudyPlan();
            break;
        case 5:
            searchPlan();
            break;
        case 0:
            echo "¡Adiós!";
            break;
        default:
            echo "Opción no disponible. Ingrese una opción válida." . PHP_EOL;
            break;
    }
} while ($option != 0);

function checkDateInput(Plan $plan): DateTime
{
    echo 'Por favor, ingrese la fecha de su plan en formato (dd-mm-aaaa): ' . PHP_EOL;
    $dateInput = trim(readline());

    $date = DateTime::createFromFormat('d-m-Y', $dateInput);

    if ($date === false) {
        throw new Exception("Formato de fecha no válido. Use (dd-mm-aaaa)." . PHP_EOL);
    }

    if (!$plan->isDateAvalaible($date)) {
        throw new Exception('Lo siento. Fecha no disponible.' . PHP_EOL);
    }

    return $date;
}

function createVacationPlan()
{
    $plan = new VacationPlan();

    $date = checkDateInput($plan);
    $plan->setDate($date);

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

    // Convert input to the correct enum case
    $type = Type::from($typeInput);
    $plan->setType($type);

    if ($plan->create()) {
        echo "¡Plan creado exitosamente!" . PHP_EOL;
    } else {
        echo "Error al crear el plan." . PHP_EOL;
    }
}

function cancelVacationPlan()
{
    $plan = new VacationPlan();

    $date = checkDateInput($plan);

    if ($plan->deletePlan($date)) {
        echo "Plan vacacional se ha eliminado con éxito." . PHP_EOL;
    } else {
        echo "Error al eliminar plan vacacional." . PHP_EOL;
    }
}

function createStudyPlan()
{
    $plan = new StudyPlan();

    $date = checkDateInput($plan);
    $plan->setDate($date);

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

function changeDateStudyPlan()
{
    $plan = new StudyPlan();
    $date = checkDateInput($plan);

    echo 'Por favor, ingrese la nueva fecha de su plan en formato (dd-mm-aaaa): ' . PHP_EOL;
    $newDateInput = trim(readline());

    $newDate = DateTime::createFromFormat('d-m-Y', $newDateInput);

    if ($newDate === false) {
        throw new Exception("Formato de nueva fecha no válido. Use (dd-mm-aaaa)." . PHP_EOL);
    }

    if ($plan->changeDate($plan, $date, $newDate)) {
        echo "Se ha planificado la reentrega." . PHP_EOL;
    } else {
        echo "Error al fijar reentrega." . PHP_EOL;
    }
}

function searchPlan()
{
    echo 'Por favor, ingrese la fecha de su plan en formato (dd-mm-aaaa): ' . PHP_EOL;
    $dateInput = trim(readline());

    $date = DateTime::createFromFormat('d-m-Y', $dateInput);

    if ($date === false) {
        throw new Exception("Formato de fecha no válido. Use (dd-mm-aaaa)." . PHP_EOL);
    }

    $vacationPlan = new VacationPlan();
    $studyPlan = new StudyPlan();

    $vacationPlans = $vacationPlan->getAllPlans();
    $studyPlans = $studyPlan->getAllPlans();

    $plans = array_merge($vacationPlans, $studyPlans);

    $found = false;
    foreach ($plans as $plan) {
        if ($plan['date'] === $dateInput) {
            echo "Plan encontrado: " . PHP_EOL;
            echo "Nombre: " . $plan['name'] . PHP_EOL;
            echo "Fecha: " . $plan['date'] . PHP_EOL;
            $found = true;
        }
    }

    if (!$found) {
        echo "No se encontraron planes para la fecha especificada." . PHP_EOL;
    }
}
