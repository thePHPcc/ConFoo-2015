<?php

// @codeCoverageIgnoreStart

// @todo We have realized that this does not work out of the box
// The other implementation works better, we don't want to spend time
// on fixing this one.
class ArnesLot implements Lot
{
    private $capacity;
    private $vehicles = [];

    public function __construct($capacity)
    {
        // @todo Make Capacity a value object (integer, > 0, < ???)
        $this->capacity = $capacity;
    }

    public function addVehicle(DateTimeImmutable $date)
    {
        $this->ensureLotIsNotFull($date);

        $this->increaseVehicleCount($date);
    }

    public function removeVehicle(DateTimeImmutable $date)
    {
        $this->ensureLotIsNotEmpty($date);

        $this->decreaseVehicleCount($date);
    }

    public function getNumberOfVehicles(DateTimeImmutable $date)
    {
        $day = $date->format('Ymd');

        if (!isset($this->vehicles[$day])) {
            return 0;
        }

        return $this->vehicles[$day];
    }

    public function hasCapacity(DateTimeImmutable $date)
    {
        return $this->getNumberOfVehicles($date) < $this->capacity;
    }

    private function ensureLotIsNotEmpty(DateTimeImmutable $date)
    {
        if ($this->getNumberOfVehicles($date) == 0) {
            throw new RuntimeException('Lot is empty');
        }
    }

    private function ensureLotIsNotFull(DateTimeImmutable $date)
    {
        if (!$this->hasCapacity($date)) {
            throw new RuntimeException('Lot is full');
        }
    }

    private function increaseVehicleCount(DateTimeImmutable $date)
    {
        $day = $date->format('Ymd');

        if (!isset($this->vehicles[$day])) {
            $this->vehicles[$day] = 0;
        }

        $this->vehicles[$day]++;
    }

    private function decreaseVehicleCount(DateTimeImmutable $date)
    {
        $day = $date->format('Ymd');

        if (!isset($this->vehicles[$day])) {
            $this->vehicles[$day] = 0;
        }

        $this->vehicles[$day]--;
    }
}
