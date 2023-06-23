<?php

declare( strict_types=1 );

namespace JazzMan\PhpCsFixerRules\Fixer;

use PhpCsFixer\AbstractFixer;
use PhpCsFixer\Fixer\WhitespacesAwareFixerInterface;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Preg;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;
use SplFileInfo;

final class BlankLineAfterClassOpeningFixer extends AbstractFixer implements WhitespacesAwareFixerInterface {

    use FixerName;

    /**
     * {@inheritdoc}
     */
    public function getDefinition(): FixerDefinitionInterface {
        return new FixerDefinition(
            'There should be one empty line after class opening brace.',
            [
                new CodeSample(
                    '<?php
final class Sample {

    protected function foo() {
    }
}
'
                ),
            ]
        );
    }

    /**
     * {@inheritdoc}
     *
     * @param Tokens<Token> $tokens
     */
    public function isCandidate( Tokens $tokens ): bool {
        return $tokens->isAnyTokenKindsFound( Token::getClassyTokenKinds() );
    }

    /**
     * {@inheritdoc}
     *
     * @param Tokens<Token> $tokens
     */
    protected function applyFix( SplFileInfo $file, Tokens $tokens ): void {
        foreach ( $tokens as $index => $token ) {
            if ( ! $token->isClassy() ) {
                continue;
            }

            $startBraceIndex = $tokens->getNextTokenOfKind( $index, ['{'] );

            if ( ! $tokens[$startBraceIndex + 1]->isWhitespace() ) {
                continue;
            }

            $this->fixWhitespace( $tokens, $startBraceIndex + 1 );
        }
    }

    /**
     * Cleanup a whitespace token.
     *
     * @param Tokens<Token> $tokens
     */
    private function fixWhitespace( Tokens $tokens, int $index ): void {
        $content = $tokens[$index]->getContent();

        // there should be two new lines
        if ( 2 !== substr_count( $content, "\n" ) ) {
            $lineEnding = $this->whitespacesConfig->getLineEnding();

            $emptyLines = $lineEnding.$lineEnding;
            $indent = 1 === Preg::match( '/^.*\R( *)$/s', $content, $matches ) ? $matches[1] : '';

            $tokens[$index] = new Token( [T_WHITESPACE, $emptyLines.$indent] );
        }
    }
}
