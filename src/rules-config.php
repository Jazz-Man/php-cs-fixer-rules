<?php

require_once __DIR__.'/FixerName.php';

require_once __DIR__.'/BlankLineAfterClassOpeningFixer.php';

require_once __DIR__.'/SpaceInsideParenthesisFixer.php';

require_once __DIR__.'/Finder.php';

require_once __DIR__.'/Config.php';

use JazzMan\PhpCsFixerRules\Config;
use JazzMan\PhpCsFixerRules\Finder;

$finder = Finder::getFinder(__DIR__);

return (new Config())->setFinder($finder);
