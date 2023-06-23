<?php

namespace JazzMan\PhpCsFixerRules\Fixer;

trait FixerName {

    public function getName(): string {
        $name = parent::getName();

        return 'WeDevs/'.$name;
    }
}
