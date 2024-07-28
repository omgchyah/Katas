<?php declare(strict_types=1);

abstract class Plan
{
    public DateTime $date;
    public string $name;
    public string $filePath;

    public function __construct()
    {
        $this->filePath = "plans.json";
    }

    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
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

    public function writeToFile(array $plans): void
    {
        file_put_contents($this->filePath, json_encode($plans, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    public function isDateAvalaible(DateTime $date): bool
    {
        $plans = $this->getAllPlans();

        foreach ($plans as $plan) {
            if (DateTime::createFromFormat('d-m-Y', $plan['date']) == $date) {
                return false;
            }
        }
        return true;
    }
}
