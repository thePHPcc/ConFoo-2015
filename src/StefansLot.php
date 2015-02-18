<?php

class StefansLot implements Lot
{
    private $changes = [];

    private $capacity;
    private $entries = [];
    private $removals = [];

    public static function fromParameters($capacity)
    {
        return new static([new LotCreatedChange($capacity)]);
    }

    public static function fromChanges(array $changes)
    {
        return new static($changes);
    }

    private function __construct(array $changes)
    {
        $this->replayChanges($changes);
    }

    /*
    public function __construct($capacity)
    {
        // @todo Make Capacity a value object (integer, > 0, < ???)
        $this->capacity = $capacity;
    }
    */

    public function addVehicle(DateTimeImmutable $date)
    {
        $this->ensureLotIsNotFull($date);

        $this->recordChange(new VehicleAddedChange($date));
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

    private function apply(Change $change)
    {
        switch(get_class($change)) {
            case 'VehicleAddedChange':
                $this->entries[] = $change->getDate();
        }
    }

    private function replayChanges(array $changes)
    {
        foreach ($changes as $change) {
            $this->apply($change);
        }
    }

    private function recordChange(Change $change)
    {
        $this->apply($change);
        $this->change[] = $change;
    }

    public function retrieveChanges()
    {
        $changes = $this->changes;
        $this->changes = [];
        return $changes;
    }
}

interface Change
{
}

class LotCreatedChange implements Change
{
    private $capacity;

    public function __construct($capacity)
    {
        $this->capacity = $capacity;
    }

    public function getCapacity()
    {
        return $this->capacity;
    }
}

class VehicleAddedChange implements Change
{
    private $date;

    public function __construct(DateTimeImmutable $date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }
}
