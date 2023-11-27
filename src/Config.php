<?php

namespace JazzMan\PhpCsFixerRules;

use JazzMan\PhpCsFixerRules\Fixer\BlankLineAfterClassOpeningFixer;
use JazzMan\PhpCsFixerRules\Fixer\SpaceInsideParenthesisFixer;

final class Config extends \PhpCsFixer\Config {

    public function __construct( string $name = 'default' ) {
        parent::__construct( $name );

        $this->setUsingCache( true );
        $this->setRiskyAllowed( true );

        $this->registerCustomFixers( [
            new SpaceInsideParenthesisFixer(),
            new BlankLineAfterClassOpeningFixer(),
        ] );
    }

    public function getRules(): array {

        return [
            '@PSR12' => true,
            '@PhpCsFixer' => true,
            '@PhpCsFixer:risky' => true,
            '@PHP82Migration' => true,
            '@PHP80Migration:risky' => true,
            'WeDevs/space_inside_parenthesis' => true,
            'WeDevs/blank_line_after_class_opening' => true,
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
            'control_structure_continuation_position' => [ 'position' => 'same_line' ],
            'braces_position' => [
                'anonymous_classes_opening_brace' => 'same_line',
                'anonymous_functions_opening_brace' => 'same_line',
                'classes_opening_brace' => 'same_line',
                'control_structures_opening_brace' => 'same_line',
                'functions_opening_brace' => 'same_line',
            ],
            'declare_strict_types' => false,
            'general_phpdoc_tag_rename' => [ 'fix_annotation' => true, 'fix_inline' => true ],
            'global_namespace_import' => [ 'import_classes' => true ],
            'heredoc_indentation' => false,
            'no_blank_lines_after_class_opening' => false,
            'no_extra_blank_lines' => [ 'tokens' => [ 'extra', 'parenthesis_brace_block', 'square_brace_block', 'throw', 'use' ] ],
            'no_spaces_around_offset' => [ 'positions' => [ 'outside' ] ],
            'spaces_inside_parentheses' => [ 'space' => 'single' ],
            'no_superfluous_phpdoc_tags' => [ 'allow_mixed' => true, 'allow_unused_params' => true ],
            'not_operator_with_successor_space' => true,
            'nullable_type_declaration_for_default_null_value' => true,
            'ordered_interfaces' => true,
            'ordered_types' => [ 'null_adjustment' => 'always_last' ],
            'phpdoc_line_span' => true,
            'phpdoc_param_order' => true,
            'phpdoc_to_comment' => false,
            'phpdoc_to_param_type' => true,
            'phpdoc_to_property_type' => true,
            'phpdoc_to_return_type' => true,
            'phpdoc_types_order' => [ 'null_adjustment' => 'always_last', 'sort_algorithm' => 'none' ],
            'single_line_comment_style' => [ 'comment_types' => [ 'hash' ] ],
            'single_line_empty_body' => true,
            'single_line_throw' => true,
            'trim_array_spaces' => false,
            'yoda_style' => [ 'always_move_variable' => true, 'equal' => true, 'identical' => true, 'less_and_greater' => true ],
        ];
    }
}
