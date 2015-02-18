<?php

class BranchSketch
{
    private $lot;
    private $reservations = [];
    private $unavailableVehicles = [];

    public function __construct(Lot $lot)
    {
        $this->lot = $lot;
    }

    public function makeReservation(Reservation $reservation)
    {
        $this->reservations[] = $reservation;
        $this->lot->removeVehicle($reservation->getStartDate());
        $this->lot->addVehicle($reservation->getReturnDate());

        $this->recordCarAsUnavailableForRent($reservation->getReturnDate());
    }

    public function sendCarToOtherLot(DateTimeImmutable $date)
    {
        $this->lot->removeVehicle($date);
    }

    public function orderCarFromOtherLot(DateTimeImmutable $date)
    {
        $this->lot->addVehicle($date);
    }

    public function getTotalNumberOfReservations()
    {
        return count($this->reservations);
    }

    public function getNumberOfAvailableVehicles(DateTimeImmutable $date)
    {
        return $this->lot->getNumberOfVehicles($date) - $this->getNumberOfUnavailableCars($date);
    }

    private function recordCarAsUnavailableForRent(DateTimeImmutable $date)
    {
        $day = $date->format('Ymd');

        if (!isset($this->unavailableVehicles[$day])) {
            $this->unavailableVehicles[$day] = 0;
        }

        $this->unavailableVehicles[$day]++;
    }

    private function getNumberOfUnavailableCars(DateTimeImmutable $date)
    {
        $day = $date->format('Ymd');

        if (!isset($this->unavailableVehicles[$day])) {
            $this->unavailableVehicles[$day] = 0;
        }

        return $this->unavailableVehicles[$day];
    }
}
