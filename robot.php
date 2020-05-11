<?php

use Robot\Robot;
use Robot\Carpet;
use Robot\Hard;

require 'vendor/autoload.php';

$carpet = new Carpet();
$hard = new Hard();

$robot = new Robot(...[$carpet, $hard]);

/** @throws InvalidArgumentException */
$robot->input($argv);

$robot->clean();
