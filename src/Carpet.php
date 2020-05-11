<?php

namespace Robot;

class Carpet implements FloorInterface
{
    const TYPE = 'carpet';

    public function support($floor): bool
    {
        return $floor == self::TYPE;
    }

    public function estimate(): int
    {
        return 1;
    }
}
