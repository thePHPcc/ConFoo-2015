<?php

class Branch
{
    private $lot;
    private $reservations = [];

    public function __construct(Lot $lot)
    {
        $this->lot = $lot;
    }

    public function makeReservation(Reservation $reservation)
    {
        $this->reservations[] = $reservation;
        $this->lot->removeVehicle($reservation->getStartDate());
        $this->lot->addVehicle($reservation->getReturnDate());
    }

    public function getTotalNumberOfReservations()
    {
        return count($this->reservations);
    }
}
