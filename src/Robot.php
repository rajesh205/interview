<?php

namespace Robot;

class Robot
{
    /**
     * @var FloorInterface[]
     */
    private $surfaces = [];

    /**
     * @var int
     */
    private $battery = 60;

    /**
     * @var FloorInterface
     */
    private $defaultSurface;

    private $area;

    /**
     * Constructor
     */
    public function __construct(?FloorInterface ...$surfaces)
    {
        $this->surfaces = $surfaces;
    }


    public function clean()
    {

        $m = 0;
        do {

            sprintf('Clean %d', $m);

            $e = $this->defaultSurface->estimate();

            $this->battery = $this->battery - $e;

            $m = $m + $e;

            if ($this->battery == 0) {
                $this->chargeBattery();
            }


        } while ($m <= $this->area);

    }


    public function chargeBattery()
    {
        echo 'Battry charge';
        $this->battery = 60;
    }


    /**
     * Input
     */
    public function input(array $input)
    {
        $command = isset($input[1]) ? $input[1] : '';

        if ($command != 'clean') {
            throw new \InvalidArgumentException('Invalid command');
        }

        if (!(isset($input[2]) && strpos('--floor', $input[2]) === false)) {
            throw new \InvalidArgumentException('Missing --floor={hard/carpet} parameter');
        }

        [$param, $floor] = explode('=', $input[2]);

        if (count($this->surfaces) == 0) {
            throw new \InvalidArgumentException('Please floor type');
        }

        foreach ($this->surfaces as $surface) {
            if ($surface->support($floor)) {
                $this->defaultSurface = $surface;
            }
        }

        if (is_null($this->defaultSurface)) {
            throw new InvalidArgumentException('Missing --floor={hard/carpet} parameter');
        }

        if (!(isset($input[3]) && strpos('--area', $input[3]) === false)) {
            throw new InvalidArgumentException('Missing --floor={hard/carpet} parameter');
        }

        [$param, $area] = explode('=', $input[3]);

        if ($area == 0) {
            throw new \InvalidArgumentException('Area shouldn\'t zero');
        }

        $this->area = $area;
    }
}
