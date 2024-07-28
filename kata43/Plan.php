<?php declare(strict_types=1);

abstract class Plan
{
    public DateTime $date;
    public string $name;

    public function __construct(DateTime $date, string $name)
    {
        $this->date = $date;
        $this->name = $name;
    }

}