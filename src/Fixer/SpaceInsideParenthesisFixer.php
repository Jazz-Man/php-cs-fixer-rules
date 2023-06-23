<?php

declare( strict_types=1 );

namespace JazzMan\PhpCsFixerRules\Fixer;

use PhpCsFixer\AbstractFixer;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\CT;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;
use SplFileInfo;

final class SpaceInsideParenthesisFixer extends AbstractFixer {

    use FixerName;

    /**
     * @var string
     */
    private const KIND_START = '(';

    /**
     * @var string
     */
    private const KIND_END = ')';

    /**
     * @var string
     */
    private const NEW_LINE = "\n";

    /**
     * @var string
     */
    private const WHITE_SPACE = ' ';

    private string $singleLineWhitespaceOptions = " \t";

    /**
     * {@inheritdoc}
     *
     * @param Tokens<Token> $tokens
     */
    public function isCandidate( Tokens $tokens ): bool {
        return $tokens->isTokenKindFound( self::KIND_START );
    }

    /**
     * {@inheritdoc}
     */
    public function getDefinition(): FixerDefinitionInterface {
        return new FixerDefinition(
            'There MUST be a space after the opening parenthesis and a space before the closing parenthesis.',
            [
                new CodeSample(
                    '<?php

class Foo
{
    public static function bar($baz , $foo)
    {
        return false;
    }
}

function  foo( $bar, $baz )
{
    return false;
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
    protected function applyFix( SplFileInfo $file, Tokens $tokens ): void {
        foreach ( $tokens as $index => $token ) {
            if ( ! $token->equals( self::KIND_START ) ) {
                continue;
            }

            // don't process if the next token is `)`
            $nextMeaningfulTokenIndex = $tokens->getNextMeaningfulToken( $index );

            if ( self::KIND_END === $tokens[$nextMeaningfulTokenIndex]->getContent() ) {
                continue;
            }

            $endParenthesisIndex = $tokens->findBlockEnd( Tokens::BLOCK_TYPE_PARENTHESIS_BRACE, $index );

            $afterParenthesisIndex = $tokens->getNextNonWhitespace( $endParenthesisIndex );
            $afterParenthesisToken = $tokens[$afterParenthesisIndex];

            if ( $afterParenthesisToken->isGivenKind( CT::T_USE_LAMBDA ) ) {
                $useStartParenthesisIndex = $tokens->getNextTokenOfKind( $afterParenthesisIndex, [self::KIND_START] );
                $useEndParenthesisIndex = $tokens->findBlockEnd( Tokens::BLOCK_TYPE_PARENTHESIS_BRACE, $useStartParenthesisIndex );

                // add single-line edge whitespaces inside use parentheses
                $this->fixParenthesisInnerEdge( $tokens, $useStartParenthesisIndex, $useEndParenthesisIndex );
            }

            // add single-line edge whitespaces inside parameters list parentheses
            $this->fixParenthesisInnerEdge( $tokens, $index, $endParenthesisIndex );
        }
    }

    /**
     * @param Tokens<Token> $tokens
     */
    private function fixParenthesisInnerEdge( Tokens $tokens, ?int $start, int $end ): void {
        // add single-line whitespace before )
        if ( ! $tokens[$end - 1]->isWhitespace( $this->singleLineWhitespaceOptions ) && ! str_contains( (string) $tokens[$end - 1]->getContent(), self::NEW_LINE ) ) {
            $tokens->ensureWhitespaceAtIndex( $end, 0, self::WHITE_SPACE );
        }

        // add single-line whitespace after (
        if ( $tokens[$start + 1]->isWhitespace( $this->singleLineWhitespaceOptions ) ) {
            return;
        }

        if ( str_contains( (string) $tokens[$start + 1]->getContent(), self::NEW_LINE ) ) {
            return;
        }

        $tokens->ensureWhitespaceAtIndex( $start, 1, self::WHITE_SPACE );
    }
}
