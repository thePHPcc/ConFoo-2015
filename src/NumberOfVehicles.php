<?php

class NumberOfVehicles
{
    private $numberOfCars = 0;

    public function __construct($numberOfCars)
    {
        $this->ensureIsInteger($numberOfCars);
        $this->ensureIsPositive($numberOfCars);

        $this->numberOfCars = $numberOfCars;
    }

    public function asInt()
    {
        return (int) $this->numberOfCars;
    }

    private function ensureIsInteger($numberOfCars)
    {
        if (!is_int($numberOfCars)) {
            throw new InvalidArgumentException(sprintf('"%s" must be an integer', $numberOfCars));
        }
    }

    private function ensureIsPositive($numberOfCars)
    {
        if ($numberOfCars < 1) {
            throw new InvalidArgumentException(sprintf('"%s" must be positive', $numberOfCars));
        }
    }
}
