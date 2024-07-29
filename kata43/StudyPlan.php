<?php declare(strict_types=1);

require 'Plan.php';

enum Sprint: int
{
    case One = 1;
    case Two = 2;
    case Three = 3;
    case Four = 4;
    case Five = 5;

    public function description(): string
    {
        return match($this) {
            Sprint::One => 'Sprint 1: Maquetación y PHP',
            Sprint::Two => 'Sprint 2: Bases de datos',
            Sprint::Three => 'Sprint 3: PHP y patrones',
            Sprint::Four => 'Sprint 4: Laravel básico',
            Sprint::Five => 'Sprint 5: Laravel API REST',
        };
    }
}

class StudyPlan extends Plan
{
    public Sprint $sprint;
    public string $gitHubLink;
    public string $notes;

    public function __construct()
    {
        parent::__construct();
    }

    public function setSprint(Sprint $sprint): void
    {
        $this->sprint = $sprint;
    }

    public function setGitHubLink(string $gitHubLink): void
    {
        $this->gitHubLink = $gitHubLink;
    }

    public function setNotes(string $notes): void
    {
        $this->notes = $notes;
    }

    public function create(): bool
    {
        $plans = $this->getAllPlans();

        if ($this->isDateAvalaible($this->date)) {
            $data = [
                'date' => $this->date->format('d-m-Y'),
                'name' => $this->name,
                'sprint' => $this->sprint->description(),
                'gitHubLink' => $this->gitHubLink,
                'notes' => $this->notes
            ];

            $plans[] = $data;
            $this->writeToFile($plans);
            return true;
        }
        return false;
    }

    public function changeDate(Plan $plan, DateTime $date)
    {
        
    }
}
