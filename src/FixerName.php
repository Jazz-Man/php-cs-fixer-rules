<?php

declare(strict_types=1);

namespace JazzMan\PhpCsFixerRules;

trait FixerName {
    public function getName(): string {
        $name = parent::getName();

        return 'JazzMan/' . $name;
    }
}
