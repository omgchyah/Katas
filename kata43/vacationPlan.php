<?php declare(strict_types=1);

enum Type: string
{
    case Restaurant = 'Restaurant';
    case Sports = 'Sports';
    case Cultural = 'Cultural';
    case Visit = 'Visit';
}

class VacationPlan extends Plan
{
    public string $location;
    public Type $type;

    public function __construct()
    {
        parent::__construct();
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    public function setType(Type $type): void
    {
        $this->type = $type;
    }

    public function create(): bool
    {
        $plans = $this->getAllPlans();

        if ($this->isDateAvalaible($this->date)) {
            $data = [
                'date' => $this->date->format('d-m-Y'),
                'name' => $this->name,
                'location' => $this->location,
                'type' => $this->type->value,
            ];

            $plans[] = $data;
            $this->writeToFile($plans);
            return true;
        }
        return false;
    }
}
