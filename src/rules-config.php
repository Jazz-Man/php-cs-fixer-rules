<?php

namespace JazzMan\PhpCsFixerRules;

use PhpCsFixer\ConfigInterface;

require_once __DIR__.'/Fixer/FixerName.php';

require_once __DIR__.'/Fixer/SpaceInsideParenthesisFixer.php';

require_once __DIR__.'/Fixer/BlankLineAfterClassOpeningFixer.php';

require_once __DIR__.'/Finder.php';

require_once __DIR__.'/Config.php';

function phpCsFixerConfig( string $projectRootDirName ): ConfigInterface {
    $finder = Finder::getFinder( $projectRootDirName );

    return ( new Config() )->setFinder( $finder );
}
