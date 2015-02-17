<?php

class GoodLot implements Lot
{
    private $capacity;
    private $entries = [];
    private $removals = [];

    public function __construct($capacity)
    {
        // @todo Make Capacity a value object (integer, > 0, < ???)
        $this->capacity = $capacity;
    }

    public function addVehicle(DateTimeImmutable $date)
    {
        $this->ensureLotIsNotFull($date);

        $this->entries[] = $date;
    }

    public function removeVehicle(DateTimeImmutable $date)
    {
        $this->ensureLotIsNotEmpty($date);

        $this->removals[] = $date;
    }

    public function getNumberOfVehicles(DateTimeImmutable $date)
    {
        $count = 0;

        foreach ($this->entries as $entry) {
            if ($entry <= $date) {
                $count++;
            }
        }

        foreach ($this->removals as $removal) {
            if ($removal <= $date) {
                $count--;
            }
        }

        return $count;
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

    public function hasCapacity(DateTimeImmutable $date)
    {
        return $this->getNumberOfVehicles($date) < $this->capacity;
    }
}
