<?php

namespace ArtsPeople\PHPStan\Rules\Keywords;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PhpParser\Node\Stmt\Global_;

class GlobalKeywordRule implements Rule
{
    /**
     * @inheritDoc
     */
    public function getNodeType(): string
    {
        return Global_::class;
    }

    /**
     * @inheritDoc
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if (!is_array($node->vars) || empty($node->vars)) {
            return [];
        }

        $variables = [];
        foreach ($node->vars as $variable) {
            $variables[] = sprintf(
                'Variable $%s accessed globally',
                $variable->name
            );
        }

        return $variables;
    }
}
