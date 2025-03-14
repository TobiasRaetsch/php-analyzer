<?php
declare(strict_types = 1);

namespace Isfett\PhpAnalyzer\Node\Representation\Expr;

use Isfett\PhpAnalyzer\Node\Representation\AbstractRepresentation;

/**
 * Class ErrorSuppress
 */
class ErrorSuppress extends AbstractRepresentation
{
    /**
     * @return string
     */
    public function representation(): string
    {
        /** @var \PhpParser\Node\Expr\ErrorSuppress $node */
        $node = $this->node;

        return sprintf(
            '@%s',
            $this->representate($node->expr)
        );
    }
}
