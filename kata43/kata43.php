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

function validateDateFormat(): DateTime
{
    echo 'Por favor, ingrese la fecha en formato (dd-mm-aaaa): ' . PHP_EOL;
    $dateInput = trim(readline());

    $date = DateTime::createFromFormat('d-m-Y', $dateInput);

    if ($date === false) {
        throw new Exception("Formato de fecha no válido. Use (dd-mm-aaaa)." . PHP_EOL);
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

    $date = validateDateFormat();

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
    echo 'Ingrese la fecha del plan a modificar en formato (dd-mm-aaaa): ' . PHP_EOL;
    $date = validateDateFormat();

    $plan = new StudyPlan();
    $planData = $plan->findPlanByDate($date);

    if ($planData === null) {
        echo "No se encontró ningún plan con la fecha especificada." . PHP_EOL;
        return;
    }

    echo 'Ingrese la nueva fecha del plan en formato (dd-mm-aaaa): ' . PHP_EOL;

    $dateInput = trim(readline());

    if ($dateInput === false) {
        throw new Exception("Formato de fecha no válido. Use (dd-mm-aaaa)." . PHP_EOL);
    }

    $newDate = DateTime::createFromFormat('d-m-Y', $dateInput);

    if ($date === false) {
        throw new Exception("Formato de fecha no válido. Use (dd-mm-aaaa)." . PHP_EOL);
    }

    $plans = $plan->getAllPlans();

    foreach ($plans as &$p) {
        if ($p['date'] === $date->format('d-m-Y')) {
            $p['date'] = $newDate->format('d-m-Y');
            break;
        }
    }

    $plan->writeToFile($plans);

    echo "La fecha del plan ha sido cambiada exitosamente." . PHP_EOL;
}

function searchPlan()
{
    echo 'Por favor, ingrese la fecha de su plan en formato (dd-mm-aaaa): ' . PHP_EOL;
    $dateInput = trim(readline());

    $date = DateTime::createFromFormat('d-m-Y', $dateInput);

    if ($date === false) {
        throw new Exception("Formato de fecha no válido. Use (dd-mm-aaaa)." . PHP_EOL);
    }

    $planType = (new VacationPlan())->searchPlanType($date);

    if ($planType === "Plan Vacacional") {
        $plan = new VacationPlan();
    } elseif ($planType === "Plan de Estudio") {
        $plan = new StudyPlan();
    } else {
        echo "No se encontraron planes para la fecha especificada." . PHP_EOL;
        return;
    }

    $planData = $plan->findPlanByDate($date);

    if ($planData !== null) {
        echo "Plan encontrado: " . PHP_EOL;
        echo "Nombre: " . $planData['name'] . PHP_EOL;
        echo "Fecha: " . $planData['date'] . PHP_EOL;

        if ($plan instanceof VacationPlan) {
            echo "Tipo: " . $planData['type'] . PHP_EOL;
            echo "Ubicación: " . $planData['location'] . PHP_EOL;
        } elseif ($plan instanceof StudyPlan) {
            echo "Tipo: " . $planData['type'] . PHP_EOL;
            echo "Sprint: " . $planData['sprint'] . PHP_EOL;
            echo "GitHub Link: " . $planData['gitHubLink'] . PHP_EOL;
            echo "Notas: " . $planData['notes'] . PHP_EOL;
        }
    } else {
        echo "No se encontraron planes para la fecha especificada." . PHP_EOL;
    }
}
