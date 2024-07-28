<?php declare(strict_types=1);

require 'StudyPlan.php';
require 'VacationPlan.php';

echo "Hola. Por favor, indique si desea guardar un plan de estudios o un plan de vacaciones ('E' o 'V'): " . PHP_EOL;

$planType = trim(readline());

if($planType = 'E') {
    $plan = new StudyPlan();
} else {
    $plan = new VacationPlan();
}

echo 'Por favor, ingrese la fecha de su plan en formato (dd-mm-aaaa): ' . PHP_EOL;

$dateInput = trim(readline());

$date = DateTime::createFromFormat('d-m-Y', $dateInput);



if ($date === false) {
        throw new Exception("Formato de fecha no válido. Use (dd-mm-aaaa)." . PHP_EOL);
    }

if (!$plan->isDateAvalaible($date)) {
    echo 'Lo siento. Fecha no disponible.' . PHP_EOL;
    exit;
}

$data = ['date' => $dateInput];

if ($plan->isDateAvalaible($date) && $planType == 'E') {
    echo 'Ingrese el nombre del plan: ' . PHP_EOL;
    $data['name'] = trim(readline());
    

    echo 'Ingrese el número de Sprint (1-5): ' . PHP_EOL;
    $data['sprint'] = (int)trim(readline());

    echo 'Ingrese el enlace de GitHub: ' . PHP_EOL;
    $data['gitHubLink'] = trim(readline());

    echo 'Si lo desea, agregué alguna nota: ' . PHP_EOL;
    $data['notes'] = trim(readline());


} else if ($plan->isDateAvalaible($date) && $planType == 'V') {
    echo 'Ingrese el nombre del plan: ' . PHP_EOL;
    $data['name'] = trim(readline());

    echo 'Ingrese la ubicación del plan: ' . PHP_EOL;
    $data['location'] = trim(readline());

    echo 'Ingrese el tipo del plan (Restaurant, Sports, Cultural, Visit): ' . PHP_EOL;
    $data['type'] = trim(readline());
}

if ($plan->create($data)) {
    echo "¡Plan creado exitosamente!" . PHP_EOL;
} else {
    echo "Error al crear el plan." . PHP_EOL;
}







