<?php

require __DIR__ . '/src/autoload.php';

// if (user_comes_from_germany() && today_is_tuesday())

if (rand(0, 1) == 0) {
    var_dump('Good Lot');
    $lot = new GoodLot(10);
} else {
    var_dump('Arnes Lot');
    $lot = new ArnesLot(10);
}

$renderer = new ToDoListHtmlRenderer();

$tomorrow = new DateTimeImmutable('tomorrow');

$lot->addVehicle($tomorrow);
$lot->addVehicle($tomorrow);
$lot->addVehicle($tomorrow);

$branch = new Branch($lot);
$branch->makeReservation(new Reservation($tomorrow, new Duration(1)));
$branch->makeReservation(new Reservation($tomorrow, new Duration(2)));

$toDoList = new DailyToDoList(
    $tomorrow,
    new NumberOfVehicles($branch->getTotalNumberOfReservations()),
    new NumberOfVehicles($lot->getNumberOfVehicles($tomorrow))
);

var_dump($toDoList->renderWith($renderer));
