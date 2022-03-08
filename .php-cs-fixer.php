<?php

require_once __DIR__ . '/src/loader.php';

use JazzMan\PhpCsFixerRules\Config;
use JazzMan\PhpCsFixerRules\Finder;

$finder = Finder::getFinder(__DIR__);

$config = (new Config());

return $config->setFinder($finder);
