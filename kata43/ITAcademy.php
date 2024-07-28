<?php declare(strict_types=1);

enum Sprint
{
    case Restaurant;
    case Sports;
    case Cultural;
    case Visit;
}

class ITAcademy
{

    public int $id;
    public string $name;
    public Sprint $sprint;
    public DateTime $date;
    public string $gitHubLink;
    public string $notes;
    public string $filePath;


    public function __construct(int $id,
string $name, Sprint $sprint, DateTime $date, string $gitHubLink, string $notes, string $filePath)
    {
        $this->id = $id;
       $this->name = $name;
       $this->sprint = $sprint;
       $this->date = $date;
       $this->$gitHubLink = $gitHubLink;
       $this->notes = $notes;
       $this->filePath = "studyStuff.json";
    }


    public function getAllPlans(): array
    {
    // Read the existing data from the JSON file
    if (file_exists($this->filePath)) {
        $jsonContent = file_get_contents($this->filePath);
            return json_decode($jsonContent, true);
        } else {
            return [];
            }
    }


    public function writeToFile(array $plans): void{
        file_put_contents($this->filePath, json_encode($plans, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    public function create(array $data): bool
    {
        $plans = $this->getAllPlans();

        $data = array_merge([
            'id' => $this->id,
            'date' => $this->date->format('d-m-Y'),
            'name' => $this->name,
            'sprint' => $this->sprint,
            'gitHubLink' => $this->gitHubLink,
            'notes' => $this->notes
        ], $data);

        if (empty($plans)) {
            $data['id'] = 1;
        } else {
            $lastPlan = end($tasks);
            $data['id'] = $lastPlan['id'] + 1;
        }

        $plans[] = $data;

        $this->writeToFile($plans);
        
        return true;
    }


}


