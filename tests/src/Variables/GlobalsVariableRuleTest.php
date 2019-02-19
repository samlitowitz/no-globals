<?php declare(strict_types=1);

namespace ArtsPeople\PHPStan\Rules\Variable;

use ArtsPeople\PHPStan\Rules\Variables\GlobalsVariableRule;
use \PHPStan\Rules\Rule;
use \PHPStan\Testing\RuleTestCase;

class GlobalsVariableRuleTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new GlobalsVariableRule();
    }

    public function testRule(): void
    {
        $this->analyse(
            [
                __DIR__ . '/data/globals-class.php',
                __DIR__ . '/data/globals.php',
            ],
            [
                [
                    'Use of $GLOBALS',
                    9,
                ],
                [
                    'Use of $GLOBALS',
                    10,
                ],
                [
                    'Use of $GLOBALS',
                    3,
                ],
                [
                    'Use of $GLOBALS',
                    4,
                ],
                [
                    'Use of $GLOBALS',
                    9,
                ],
                [
                    'Use of $GLOBALS',
                    10,
                ],
            ]
        );
    }
}