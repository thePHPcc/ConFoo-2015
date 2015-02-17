<?php

class Reservation
{
    /**
     * @var DateTimeImmutable
     */
    private $startDate;

    /**
     * @var Duration
     */
    private $duration;

    public function __construct(DateTimeImmutable $startDate, Duration $duration)
    {
        $this->duration = $duration;
        $this->startDate = $startDate;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @return Duration
     */
    public function getDuration()
    {
        return $this->duration;
    }

    public function getReturnDate()
    {
        return $this->getStartDate()->modify('+' . $this->duration->asInt() . ' days');
    }
}
