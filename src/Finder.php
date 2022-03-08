<?php

declare(strict_types=1);

namespace JazzMan\PhpCsFixerRules;

class Finder {
    /**
     * @param string $projectRootDirName
     *
     * @return \PhpCsFixer\Finder
     */
    public static function getFinder(string $projectRootDirName): \PhpCsFixer\Finder {
        return (new \PhpCsFixer\Finder())
            ->in($projectRootDirName)
            ->ignoreDotFiles(true)
            ->ignoreVCS(true)
            ->ignoreVCSIgnored(true)
            ->ignoreUnreadableDirs(true)
            ->files()
            ->notName(['rector.php'])
            ->name('*.php')
            ->exclude(['vendor', 'php-cs-fixer', 'node_modules', '.idea', '.github', 'cache']);
    }
}
