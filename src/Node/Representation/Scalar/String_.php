<?php
declare(strict_types = 1);

namespace Isfett\PhpAnalyzer\Node\Representation\Scalar;

use Isfett\PhpAnalyzer\Node\Representation\AbstractRepresentation;

/**
 * Class String_
 */
class String_ extends AbstractRepresentation
{
    /**
     * @return string
     */
    public function representation(): string
    {
        /** @var \PhpParser\Node\Scalar\String_ $node */
        $node = $this->node;

        return sprintf("'%s'", $node->value);
    }
}
