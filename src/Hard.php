<?php

namespace Robot;


class Hard implements FloorInterface
{
    const TYPE = 'hard';

    public function support($floor): bool
    {
        return $floor == self::TYPE;
    }

    public function estimate(): int
    {
        return 1;
    }
}
