<?php

class DailyToDoList
{
    private $date;
    private $numberOfCarsToRent;

    public function __construct(DateTimeImmutable $date, NumberOfCars $numberOfCarsToRent)
    {
        $this->date = $date;
        $this->numberOfCarsToRent = $numberOfCarsToRent;
    }

    public function getTotalNumbersOfCarsToRent()
    {
        return $this->numberOfCarsToRent;
    }

    public function getDate()
    {
        return $this->date;
    }
}
