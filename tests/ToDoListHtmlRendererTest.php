<?php

/**
 * @covers ToDoListHtmlRenderer
 * @uses NumberOfVehicles
 */
class ToDoListHtmlRendererTest extends PHPUnit_Framework_TestCase
{
    public function testRendersHtml()
    {
        $date = new DateTimeImmutable;
        $numberOfVehiclesToRent = new NumberOfVehicles(rand(0, 1000));
        $numberOfVehiclesInLot = new NumberOfVehicles(rand(0, 1000));

        $renderer = new ToDoListHtmlRenderer();
        $html = $renderer->render(
            $date,
            $numberOfVehiclesInLot,
            $numberOfVehiclesToRent
        );

        $this->assertContains($date->format('Y-m-d'), $html);
        $this->assertContains((string) $numberOfVehiclesInLot->asInt(), $html);
        $this->assertContains((string) $numberOfVehiclesToRent->asInt(), $html);
    }
}
