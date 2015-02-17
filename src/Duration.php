<?php

class Duration
{
    /**
     * @var int
     */
    private $duration = 0;

    /**
     * @param $duration
     */
    public function __construct($duration)
    {
        $this->ensureIsInteger($duration);
        $this->ensureIsPositive($duration);
        $this->ensureIsLessThanMaximumRentingPeriod($duration);

        $this->duration = $duration;
    }

    /**
     * @return int
     */
    public function asInt()
    {
        return (int) $this->duration;
    }

    private function ensureIsInteger($duration)
    {
        if (!is_int($duration)) {
            throw new InvalidArgumentException(sprintf('"%s" must be an integer', $duration));
        }
    }

    private function ensureIsPositive($duration)
    {
        if ($duration < 1) {
            throw new InvalidArgumentException(sprintf('"%s" must be positive', $duration));
        }
    }

    private function ensureIsLessThanMaximumRentingPeriod($duration)
    {
        if ($duration > 20) {
            throw new InvalidArgumentException(sprintf('"%d" too long', $duration));
        }
    }
}
