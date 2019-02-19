<?php

namespace ArtsPeople\PHPStan\Rules\Variables;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PhpParser\Node\Expr\Variable;

class GlobalsVariableRule implements Rule
{
    /**
     * @inheritDoc
     */
    public function getNodeType(): string
    {
        return Variable::class;
    }

    /**
     * @inheritDoc
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if (!is_string($node->name) || $node->name !== 'GLOBALS') {
            return [];
        }

        return [ 'Use of $GLOBALS' ];
    }
}
