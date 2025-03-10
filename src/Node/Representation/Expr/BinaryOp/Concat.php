<?php
declare(strict_types = 1);

namespace Isfett\PhpAnalyzer\Node\Representation\Expr\BinaryOp;

use Isfett\PhpAnalyzer\Node\Representation\AbstractRepresentation;

/**
 * Class Concat
 */
class Concat extends AbstractRepresentation
{
    /**
     * @return string
     */
    public function representation(): string
    {
        /** @var \PhpParser\Node\Expr\BinaryOp\Concat $node */
        $node = $this->node;

        return sprintf(
            '%s%s%s',
            $this->representate($node->left),
            $node->getOperatorSigil(),
            $this->representate($node->right)
        );
    }
}
