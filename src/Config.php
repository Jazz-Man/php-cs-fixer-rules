<?php

namespace JazzMan\PhpCsFixerRules;

class Config extends \PhpCsFixer\Config {
    public function __construct(string $name = 'default') {
        parent::__construct($name);

        $this->setUsingCache(true);
        $this->setRiskyAllowed(true);
    }

    public function getRules(): array {
        $rules = [[]];

        $rules[] = ['@PSR12' => true];
        $rules[] = self::getPhpCsFixerRules();
        $rules[] = self::getPhpCsFixerRiskyRules();
        $rules[] = self::getPhpRules();
        $rules[] = ['phpdoc_line_span' => ['const' => 'multi']];

        return array_merge(...$rules);
    }

    private static function getPhpRules(): array {
        return [
            '@PHP74Migration' => true,
            '@PHP74Migration:risky' => true,
            'declare_strict_types' => false,
        ];
    }

    private static function getPhpCsFixerRules(): array {
        return [
            '@PhpCsFixer' => true,
            // An empty line feed must precede any configured statement.
            'blank_line_before_statement' => [
                'statements' => [
                    'break',
                    'case',
                    'continue',
                    'declare',
                    'default',
                    'do',
                    'exit',
                    'for',
                    'foreach',
                    'goto',
                    'if',
                    'include',
                    'include_once',
                    'phpdoc',
                    'require',
                    'require_once',
                    'return',
                    'switch',
                    'throw',
                    'try',
                    'while',
                    'yield',
                    'yield_from',
                ],
            ],
            // Single-line comments and multi-line comments with only one line of actual content should use the `//` syntax.
            'single_line_comment_style' => [
                'comment_types' => [
                    'hash',
                ],
            ],
            // The body of each structure MUST be enclosed by braces. Braces should be properly placed. Body of braces should be properly indented.
            'braces' => [
                'position_after_functions_and_oop_constructs' => 'same',
                'allow_single_line_closure' => false,
            ],
            // Class, trait and interface elements must be separated with one or none blank line.
            'class_attributes_separation' => true,
            'no_alternative_syntax' => [
                'fix_non_monolithic_code' => false,
            ],
            'phpdoc_align' => [
                'align' => 'vertical',
                'tags' => [
                    'method',
                    'param',
                    'property',
                    'return',
                    'throws',
                    'type',
                    'var',
                ],
            ],
            'phpdoc_to_comment' => false,
        ];
    }

    private static function getPhpCsFixerRiskyRules(): array {
        return [
            '@PhpCsFixer:risky' => true,
            'error_suppression' => false,
            'final_internal_class' => false,
            'no_trailing_whitespace_in_string' => false,
            'no_unreachable_default_argument_value' => false,
            'no_unset_on_property' => false,
            'ordered_traits' => false,
            'strict_comparison' => false,
            'ternary_to_elvis_operator' => false,
        ];
    }
}
