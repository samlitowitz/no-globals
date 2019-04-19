<?php declare(strict_types=1);

namespace SamLitowitz\PHPStan\Rules\Variable;

use SamLitowitz\PHPStan\Rules\Variables\GlobalsVariableWriteRule;
use \PHPStan\Rules\Rule;
use \PHPStan\Testing\RuleTestCase;

class GlobalsVariableWriteRuleTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new GlobalsVariableWriteRule();
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
                    'Write to $GLOBALS[\'class_write\']',
                    9
                ],
                [
                    'Write to $GLOBALS[\'global_write\']',
                    3
                ],
                [
                    'Write to $GLOBALS[\'global_nested\'][\'write\']',
                    7
                ],
                [
                    'Write to $GLOBALS[$a]',
                    10
                ],
                [
                    'Write to $GLOBALS[$GLOBALS[$a]]',
                    12
                ],
                [
                    'Write to $GLOBALS[\'local_write\']',
                    16
                ],
            ]
        );
    }
}
