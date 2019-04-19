<?php declare(strict_types=1);

namespace SamLitowitz\PHPStan\Rules\Variable;

use SamLitowitz\PHPStan\Rules\Keywords\GlobalKeywordRule;
use \PHPStan\Rules\Rule;
use \PHPStan\Testing\RuleTestCase;

class GlobalKeywordRuleTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new GlobalKeywordRule();
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
                    'Variable $globalWrite accessed globally',
                    3,
                ],
                [
                    'Variable $globalWrite accessed globally',
                    9,
                ],
            ]
        );
    }
}
