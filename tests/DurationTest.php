<?php

/**
 * @covers Duration
 */
class DurationTest extends PHPUnit_Framework_TestCase
{
    public function testCanBeConstructed()
    {
        $this->assertInstanceOf(Duration::class, new Duration(1));
    }

    public function testDurationCanBeRetrievedAsInteger()
    {
        $duration = 1;
        $this->assertSame($duration, (new Duration($duration))->asInt());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCannotBeCreatedForNonInteger()
    {
        new Duration(0.75);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCannotBeCreatedForNonPositiveNumber()
    {
        new Duration(-1);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCannotBeCreatedForDurationThatIsTooLong()
    {
        new Duration(21);
    }
}
