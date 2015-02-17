<?php

/**
 * @covers NumberOfCars
 */
class NumberOfCarsTest extends PHPUnit_Framework_TestCase
{
    public function testCanBeConstructed()
    {
        $this->assertInstanceOf(NumberOfCars::class, new NumberOfCars(1));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCannotBeCreatedForNonInteger()
    {
        new NumberOfCars(0.75);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCannotBeCreatedForNonPositiveNumber()
    {
        new NumberOfCars(-1);
    }
}
