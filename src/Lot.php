<?php

interface Lot
{
    public function addVehicle(DateTimeImmutable $date);
    public function removeVehicle(DateTimeImmutable $date);
    public function getNumberOfVehicles(DateTimeImmutable $date);
    public function hasCapacity(DateTimeImmutable $date);
}
