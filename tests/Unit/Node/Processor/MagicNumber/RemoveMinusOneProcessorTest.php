<?php
declare(strict_types = 1);

namespace Isfett\PhpAnalyzer\Tests\Unit\Node\Processor\MagicNumber;

use Isfett\PhpAnalyzer\DAO\OccurrenceList;
use Isfett\PhpAnalyzer\Node\Processor\MagicNumber\RemoveMinusOneProcessor;
use Isfett\PhpAnalyzer\Tests\Unit\Node\AbstractNodeTestCase;
use PhpParser\Node\Expr\UnaryMinus;
use PhpParser\Node\Scalar\DNumber;
use PhpParser\Node\Scalar\LNumber;

/**
 * Class RemoveMinusOneProcessorTest
 */
class RemoveMinusOneProcessorTest extends AbstractNodeTestCase
{
    /** @var RemoveMinusOneProcessor */
    private $processor;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->processor = new RemoveMinusOneProcessor();
    }

    /**
     * @return void
     */
    public function testProcessOnInt(): void
    {
        $node = new LNumber(1, ['parent' => new UnaryMinus(new LNumber(1))]);

        $occurrence = $this->createOccurrence($node);

        $nodeOccurrenceList = new OccurrenceList();
        $nodeOccurrenceList->addOccurrence($occurrence);
        $this->processor->setNodeOccurrenceList($nodeOccurrenceList);

        $this->assertCount(1, $nodeOccurrenceList->getOccurrences());
        $this->assertEmpty($occurrence->getAffectedByProcessors());

        $this->processor->process($occurrence);

        $this->assertCount(0, $nodeOccurrenceList->getOccurrences());
    }

    /**
     * @return void
     */
    public function testProcessOnDecimal(): void
    {
        $node = new DNumber(1.00, ['parent' => new UnaryMinus(new DNumber(1.00))]);

        $occurrence = $this->createOccurrence($node);

        $nodeOccurrenceList = new OccurrenceList();
        $nodeOccurrenceList->addOccurrence($occurrence);
        $this->processor->setNodeOccurrenceList($nodeOccurrenceList);

        $this->assertCount(1, $nodeOccurrenceList->getOccurrences());
        $this->assertEmpty($occurrence->getAffectedByProcessors());

        $this->processor->process($occurrence);

        $this->assertCount(0, $nodeOccurrenceList->getOccurrences());
    }

    /**
     * @return void
     */
    public function testProcessOnIntGreaterOneWillNotRemoveOccurrence(): void
    {
        $node = new LNumber(2, ['parent' => new UnaryMinus(new LNumber(2))]);

        $occurrence = $this->createOccurrence($node);

        $nodeOccurrenceList = new OccurrenceList();
        $nodeOccurrenceList->addOccurrence($occurrence);
        $this->processor->setNodeOccurrenceList($nodeOccurrenceList);

        $this->assertCount(1, $nodeOccurrenceList->getOccurrences());
        $this->assertEmpty($occurrence->getAffectedByProcessors());

        $this->processor->process($occurrence);

        $this->assertCount(1, $nodeOccurrenceList->getOccurrences());
    }

    /**
     * @return void
     */
    public function testProcessOnDecimalGreaterOneWillNotRemoveOccurrence(): void
    {
        $node = new DNumber(1.05, ['parent' => new UnaryMinus(new DNumber(1.05))]);

        $occurrence = $this->createOccurrence($node);

        $nodeOccurrenceList = new OccurrenceList();
        $nodeOccurrenceList->addOccurrence($occurrence);
        $this->processor->setNodeOccurrenceList($nodeOccurrenceList);

        $this->assertCount(1, $nodeOccurrenceList->getOccurrences());
        $this->assertEmpty($occurrence->getAffectedByProcessors());

        $this->processor->process($occurrence);

        $this->assertCount(1, $nodeOccurrenceList->getOccurrences());
    }

    /**
     * @return void
     */
    public function testProcessOnPositiveIntWillNotRemoveOccurrence(): void
    {
        $node = new LNumber(1);

        $occurrence = $this->createOccurrence($node);

        $nodeOccurrenceList = new OccurrenceList();
        $nodeOccurrenceList->addOccurrence($occurrence);
        $this->processor->setNodeOccurrenceList($nodeOccurrenceList);

        $this->assertCount(1, $nodeOccurrenceList->getOccurrences());
        $this->assertEmpty($occurrence->getAffectedByProcessors());

        $this->processor->process($occurrence);

        $this->assertCount(1, $nodeOccurrenceList->getOccurrences());
    }
}
