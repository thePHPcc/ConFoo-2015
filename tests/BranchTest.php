<?php

/**
 * @covers Branch
 */
class BranchTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Branch
     */
    private $branch;

    /**
     * @var Lot
     */
    private $lot;

    protected function setUp()
    {
        $this->lot = $this->getMockBuilder(Lot::class)->disableOriginalConstructor()->getMock();
        $this->branch = new Branch($this->lot);
    }

    public function testInitiallyHasNoReservations()
    {
        $this->assertEquals(0, $this->branch->getTotalNumberOfReservations());
    }

    public function testReservationCanBeMade()
    {
        $startDate = new DateTimeImmutable;
        $returnDate = new DateTimeImmutable('tomorrow');

        $this->lot->expects($this->once())
                  ->method('removeVehicle')
                  ->with($startDate);

        $this->lot->expects($this->once())
                  ->method('addVehicle')
                  ->with($returnDate);

        $this->branch->makeReservation($this->createReservation($startDate, $returnDate));

        $this->assertEquals(1, $this->branch->getTotalNumberOfReservations());
    }

    public function testMultipleReservationsCanBeMade()
    {
        $startDate = new DateTimeImmutable;
        $returnDate = new DateTimeImmutable('tomorrow');

        $this->branch->makeReservation($this->createReservation($startDate, $returnDate));
        $this->branch->makeReservation($this->createReservation($startDate, $returnDate));

        $this->assertEquals(2, $this->branch->getTotalNumberOfReservations());
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    private function createReservation(DateTimeImmutable $startDate, DateTimeImmutable $returnDate)
    {
        $reservation = $this->getMockBuilder(Reservation::class)->disableOriginalConstructor()->getMock();
        $reservation->method('getStartDate')->willReturn($startDate);
        $reservation->method('getReturnDate')->willReturn($returnDate);

        return $reservation;
    }
}
