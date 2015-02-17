<?php

class DailyToDoList
{
    private $date;
    private $numberOfVehiclesToRent;
    private $numberOfVehiclesInLot;

    public function __construct(
        DateTimeImmutable $date,
        NumberOfVehicles $numberOfVehiclesToRent,
        NumberOfVehicles $numberOfVehiclesInLot
    )
    {
        $this->date = $date;
        $this->numberOfVehiclesToRent = $numberOfVehiclesToRent;
        $this->numberOfVehiclesInLot = $numberOfVehiclesInLot;
    }

    public function renderWith(ToDoListHtmlRenderer $doListHtmlRenderer)
    {
        return $doListHtmlRenderer->render(
            $this->date,
            $this->numberOfVehiclesInLot,
            $this->numberOfVehiclesToRent
        );
    }
}
