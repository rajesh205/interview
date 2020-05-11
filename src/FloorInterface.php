<?php


namespace Robot;

interface FloorInterface
{
    public function support(string $floor): bool;
    public function estimate(): int;
}
