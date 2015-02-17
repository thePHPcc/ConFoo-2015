<?php

/**
 * @covers DailyToDoList
 * @uses NumberOfVehicles
 */
class DailyToDoListTest extends PHPUnit_Framework_TestCase
{
    public function testCanBeRendered()
    {
        $date = new DateTimeImmutable;
        $totalNumberOfCarsToRent = $this->createNumberOfVehicles();
        $totalNumberOfCarsInLot = $this->createNumberOfVehicles();

        $toDoList = new DailyToDoList(
            $date,
            $totalNumberOfCarsToRent,
            $totalNumberOfCarsInLot
        );

        $renderer = $this->getMockBuilder(ToDoListHtmlRenderer::class)->disableOriginalConstructor()->getMock();

        $renderer->expects($this->once())
                 ->method('render')
                 ->with($date, $totalNumberOfCarsInLot, $totalNumberOfCarsToRent);

        $toDoList->renderWith($renderer);
    }

    /**
     * @return NumberOfVehicles
     */
    private function createNumberOfVehicles()
    {
        return new NumberOfVehicles(rand(1, 1000));
    }
}
