<?php declare(strict_types=1);

require 'StudyPlan.php';
require 'VacationPlan.php';

echo "Hola. Por favor, indique si desea guardar un plan de estudios o un plan de vacaciones ('E' o 'V'): " . PHP_EOL;

$planType = trim(readline());

if($planType = 'E') {
    $plan = new VacationPlan();
} else {
    $plan = new StudyPlan();
}

echo 'Por favor, ingrese la fecha de su plan en formato (dd-mm-aaaa): ' . PHP_EOL;

$date = trim(readline());

$date = DateTime::createFromFormat('d-m-Y', $date);

if ($date === false) {
        throw new Exception("Formato de fecha no válido. Use (dd-mm-aaaa)." . PHP_EOL);
    }

if (!$plan->isDateAvalaible($date)) {
    echo 'Lo siento. Fecha no disponible.' . PHP_EOL;
}

if ($plan->isDateAvalaible($date) && $planType = 'E') {
    echo 'Ingrese el nombre del plan: ' . PHP_EOL;
    $name = trim(readline());
    

    echo 'Ingrese el número de Sprint (1-5): ' . PHP_EOL;
    $sprintNumber = (int)trim(readline());
    $sprint = Sprint::from($sprintNumber);

    echo 'Ingrese el enlace de GitHub: ' . PHP_EOL;
    $gitHubLink = trim(readline());

    echo 'Si lo desea, agregué alguna nota: ' . PHP_EOL;
    $notes = trim(readline());

    $newPlan = [
        'date' => date->format('d-m-Y'),
        'name' => $name,
        'sprint' => $sprint->description(),
        'gitHubLink' => $gitHubLink,
        'notes' => $notes
    ];

    $plan->create($newPlan);

} else if ($plan->isDateAvalaible($date) && $planType = 'V') {
    
    echo 'Ingrese el nombre del plan: ';
    $name = trim(readline());

    echo 'Ingrese la ubicación del plan: ';
    $location = trim(readline());

    echo 'Ingrese el tipo del plan (Restaurant, Sports, Cultural, Visit): ';
    $typeInput = trim(readline());
    $type = Type::from($typeInput);

    $newPlan = [
        'date' => $date,
        'name' => $name,
        'location' => $location,
        'type' => $type
    ];

    $plan->create($newPlan);
}







