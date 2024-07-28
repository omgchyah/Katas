<?php declare(strict_types=1);

enum Type
{
    case Restaurant;
    case Sports;
    case Cultural;
    case Visit;
}

class VacationPlan
{

    public int $id;
    public string $location;
    public DateTime $date;
    public string $name;
    public Type $type;
    public $filePath;


    public function __construct(string $location, DateTime $date, string $name, Type $type, int $id)
    {
        $this->id = $id;
       $this->location = $location;
       $this->date = $date;
       $this->name = $name;
       $this->type = $type;
       $this->filePath = "funStuff.json";
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
            'location' => $this->location,
            'type' => $this->type,
        ], $data);

        if (empty($plans)) {
            $data['id'] = 1;
        } else {
            $lastPlan = end($plans);
            $data['id'] = $lastPlan['id'] + 1;
        }

        $plans[] = $data;

        $this->writeToFile($plans);
        
        return true;
    }


}


