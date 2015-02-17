<?php

class LotTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Lot
     */
    private $lot;

    protected function setUp()
    {
        $this->lot = new Lot(1);
    }

    public function testInitiallyHasNoVehicles()
    {
        $this->assertEquals(0, $this->lot->getNumberOfVehicles(new DateTimeImmutable));
    }

    public function testHasCapacityWhenNotFull()
    {
        $this->assertTrue($this->lot->hasCapacity(new DateTimeImmutable));
    }

    public function testHasNoCapacityWhenFull()
    {
        $this->lot->addVehicle(new DateTimeImmutable);
        $this->assertFalse($this->lot->hasCapacity(new DateTimeImmutable));
    }

    public function testVehicleCanBeAdded()
    {
        $this->lot->addVehicle(new DateTimeImmutable);
        $this->assertEquals(1, $this->lot->getNumberOfVehicles(new DateTimeImmutable));
    }

    public function testAddingVehiclesDoesNotChangeHistory()
    {
        $this->lot->addVehicle(new DateTimeImmutable);
        $this->assertEquals(0, $this->lot->getNumberOfVehicles(new DateTimeImmutable('yesterday')));
    }

    public function testVehicleCanBeRemoved()
    {
        $this->lot->addVehicle(new DateTimeImmutable);
        $this->lot->removeVehicle(new DateTimeImmutable);
        $this->assertEquals(0, $this->lot->getNumberOfVehicles(new DateTimeImmutable));
    }

    /**
     * @expectedException RuntimeException
     */
    public function testCannotRemoveVehicleFromEmptyLot()
    {
        $this->lot->removeVehicle(new DateTimeImmutable);
    }

    /**
     * @expectedException RuntimeException
     */
    public function testCannotAddVehicleToFullLot()
    {
        $this->lot->addVehicle(new DateTimeImmutable);
        $this->lot->addVehicle(new DateTimeImmutable);
    }

    // hasCapacity?
}
