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
        $rules[] = self::getPhpMigrationRules();
        $rules[] = ['phpdoc_line_span' => true];

        return array_merge(...$rules);
    }
    private static function getPhpMigrationRules(): array {
        return [
            '@PHP74Migration' => true,
            '@PHP74Migration:risky' => true,
            'declare_strict_types' => false,
            'use_arrow_functions' => false,
        ];
    }
    private static function getPhpCsFixerRules(): array {
        return [
            '@PhpCsFixer' => true,
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
            'class_attributes_separation' => [
                'elements' => [
                    'const' => 'only_if_meta',
                    'method' => 'only_if_meta',
                    'property' => 'only_if_meta',
                    'trait_import' => 'only_if_meta',
                    'case' => 'only_if_meta',
                ],
            ],
            'control_structure_continuation_position' => [
                'position' => 'same_line',
            ],
            'curly_braces_position' => [
                'allow_single_line_anonymous_functions' => true,
                'allow_single_line_empty_anonymous_classes' => true,
                'anonymous_classes_opening_brace' => 'same_line',
                'anonymous_functions_opening_brace' => 'same_line',
                'classes_opening_brace' => 'same_line',
                'control_structures_opening_brace' => 'same_line',
                'functions_opening_brace' => 'same_line',
            ],
            'no_alternative_syntax' => ['fix_non_monolithic_code' => false],
            'no_extra_blank_lines' => [
                'tokens' => [
                    'attribute',
                    'break',
                    'case',
                    'continue',
                    'curly_brace_block',
                    'default',
                    'extra',
                    'parenthesis_brace_block',
                    'return',
                    'square_brace_block',
                    'switch',
                    'throw',
                    'use',
                    'use_trait',
                ],
            ],
            'phpdoc_align' => [
                'align' => 'vertical',
                'tags' => [
                    'method',
                    'param',
                    'property',
                    'property-read',
                    'property-write',
                    'return',
                    'throws',
                    'type',
                    'var',
                ],
            ],
            'phpdoc_to_comment' => false,
            'single_line_comment_style' => ['comment_types' => ['hash']],
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
