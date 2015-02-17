<?php

class ToDoListHtmlRenderer
{
    public function render(
        DateTimeImmutable $date,
        NumberOfVehicles $numberOfVehiclesInLot,
        NumberOfVehicles $numberOfVehiclesToRent
    )
    {
        return sprintf(
            '[HTML] Date: %s, Cars in Lot: %d, Cars to Rent: %d',
            $date->format('Y-m-d'),
            $numberOfVehiclesInLot->asInt(),
            $numberOfVehiclesToRent->asInt()
        );
    }
}
