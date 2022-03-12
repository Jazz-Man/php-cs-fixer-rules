<?php

namespace JazzMan\PhpCsFixerRules;

trait FixerName {
    public function getName(): string {
        $name = parent::getName();

        return 'JazzMan/'.$name;
    }
}
