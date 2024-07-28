<?php declare(strict_types=1);

require 'StudyPlan.php';
require 'VacationPlan.php';

echo "Hola. Por favor, indique si desea guardar un plan de estudios o un plan de vacaciones ('E' o 'V'): " . PHP_EOL;

$planType = strtoupper(trim(readline()));

if ($planType === 'E') {
    $plan = new StudyPlan();
} elseif ($planType === 'V') {
    $plan = new VacationPlan();
} else {
    echo "Tipo de plan no válido. Use 'E' para plan de estudios o 'V' para plan de vacaciones." . PHP_EOL;
    exit;
}

echo 'Por favor, ingrese la fecha de su plan en formato (dd-mm-aaaa): ' . PHP_EOL;
$dateInput = trim(readline());
$date = DateTime::createFromFormat('d-m-Y', $dateInput);

if ($date === false) {
    throw new Exception("Formato de fecha no válido. Use (dd-mm-aaaa)." . PHP_EOL);
}

$plan->setDate($date);

if (!$plan->isDateAvalaible($date)) {
    echo 'Lo siento. Fecha no disponible.' . PHP_EOL;
    exit;
}

if ($planType === 'E') {
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

} else if ($planType === 'V') {
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
}

if ($plan->create()) {
    echo "¡Plan creado exitosamente!" . PHP_EOL;
} else {
    echo "Error al crear el plan." . PHP_EOL;
}
