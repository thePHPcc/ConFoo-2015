<?php

/**
 * @covers NumberOfVehicles
 */
class NumberOfVehiclesTest extends PHPUnit_Framework_TestCase
{
    public function testCanBeConstructed()
    {
        $this->assertInstanceOf(NumberOfVehicles::class, new NumberOfVehicles(1));
    }

    public function testCanBeConvertedToInt()
    {
        $numberOfVehicles = rand(1, 1000);
        $this->assertSame($numberOfVehicles, (new NumberOfVehicles($numberOfVehicles))->asInt());
    }

    /**
     * @expectedException InvalidArgumentException
     * @dataProvider provideInvalidInput
     */
    public function testCannotBeCreatedForNonInteger($input)
    {
        new NumberOfVehicles($input);
    }

    public function provideInvalidInput()
    {
        return [
            [0.75],
            [-1],
            [0]
        ];
    }
}
