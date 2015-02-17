<?php

/**
 * @covers Reservation
 * @uses Duration
 */
class ReservationTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Reservation
     */
    private $reservation;

    /**
     * @var DateTimeImmutable
     */
    private $startDate;

    /**
     * @var Duration
     */
    private $duration;

    /**
     * @var int
     */
    private $numberOfDays;

    protected function setUp()
    {
        $this->startDate = new DateTimeImmutable('today');
        $this->duration = new Duration(1);

        $this->reservation = new Reservation($this->startDate, $this->duration);
    }

    public function testStartDateCanBeRetrieved()
    {
        $this->assertEquals($this->startDate, $this->reservation->getStartDate());
    }

    public function testReturnDateCanBeRetrieved()
    {
        $this->assertEquals(new DateTimeImmutable('tomorrow'), $this->reservation->getReturnDate());
    }

    public function testDurationCanBeRetrieved()
    {
        $this->assertEquals($this->duration, $this->reservation->getDuration());
    }
}
