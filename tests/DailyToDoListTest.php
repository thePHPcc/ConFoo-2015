<?php

/**
 * @covers DailyToDoList
 */
class DailyToDoListTest extends PHPUnit_Framework_TestCase
{
    public function testTotalNumberOfCarsToRentCanBeRetrieved()
    {
        $totalNumberOfCarsToRent = $this->createNumberOfCars();
        $toDoList = new DailyToDoList(new DateTimeImmutable, $totalNumberOfCarsToRent);

        $this->assertEquals($totalNumberOfCarsToRent, $toDoList->getTotalNumbersOfCarsToRent());
    }

    public function testDateCanBeRetrieved()
    {
        $date = new DateTimeImmutable;
        $toDoList = new DailyToDoList($date, $this->createNumberOfCars());

        $this->assertEquals($date, $toDoList->getDate());
    }

    /**
     * @return NumberOfCars
     */
    private function createNumberOfCars()
    {
        return new NumberOfCars(rand(1, 1000));
    }
}
