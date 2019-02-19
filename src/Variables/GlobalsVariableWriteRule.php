<?php

namespace ArtsPeople\PHPStan\Rules\Variables;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PhpParser\Node\Expr\ArrayDimFetch;
use PhpParser\Node\Expr\ArrayItem;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Scalar\String_;

class GlobalsVariableWriteRule implements Rule
{
    /**
     * @inheritDoc
     */
    public function getNodeType(): string
    {
        return Node\Expr\Assign::class;
    }

    /**
     * @inheritDoc
     */
    public function processNode(Node $node, Scope $scope): array
    {

        if (
            $node->var instanceof ArrayDimFetch &&
            $this->isGlobalVariable($node->var)
        ) {
            return [
                sprintf(
                    'Write to %s',
                    $this->expandArrayDimFetch($node->var)
                ),
            ];
        }

        return [];
    }

    private function isGlobalVariable(ArrayDimFetch $node): bool
    {
        if ($node->var instanceof Variable) {
            return $node->var->name === 'GLOBALS';
        } elseif ($node->var instanceof ArrayDimFetch) {
            return $this->isGlobalVariable($node->var);
        }

        return false;
    }

    private function expandArrayDimFetch(ArrayDimFetch $node): string
    {
        if ($node->var instanceof Variable) {
            $dim = '';
            switch (true) {
                case $node->dim instanceof ArrayDimFetch:
                    $dim = $this->expandArrayDimFetch($node->dim);
                    break;

                case $node->dim instanceof Node\Expr\Cast\Int_:
                    $dim = sprintf('%d', $node->dim->value);
                    break;

                case $node->dim instanceof String_:
                    $dim = sprintf('\'%s\'', $node->dim->value);
                    break;

                case $node->dim instanceof Variable:
                    $dim = sprintf('$%s', $node->dim->name);
                    break;
            }

            return sprintf('$%s[%s]', $node->var->name, $dim);
        } elseif ($node->var instanceof ArrayDimFetch) {
            $expanded = $this->expandArrayDimFetch($node->var);

            $dim = '';
            switch (true) {
                case $node->dim instanceof ArrayDimFetch:
                    $dim = $this->expandArrayDimFetch($node->dim);
                    break;

                case $node->dim instanceof Node\Expr\Cast\Int_:
                    $dim = sprintf('%d', $node->dim->value);
                    break;

                case $node->dim instanceof String_:
                    $dim = sprintf('\'%s\'', $node->dim->value);
                    break;

                case $node->dim instanceof Variable:
                    $dim = sprintf('$%s', $node->dim->name);
                    break;
            }

            return sprintf('%s[%s]', $expanded, $dim);
        }
        return '';
    }
}
