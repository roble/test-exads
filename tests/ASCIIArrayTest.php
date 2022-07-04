<?php

declare(strict_types=1);

namespace RenanRoble\Exads;

use PHPUnit\Framework\TestCase;
use RenanRoble\Exads\ASCIIArray;

final class ASCIIArrayTest extends TestCase
{

    private $from;
    private $to;
    private $expectedSize;
    private $array;
    private $removedElement;

    protected function setUp(): void
    {
        $this->from = ',';
        $this->to = '|';

        $this->expectedSize = ord($this->to) - ord($this->from) + 1;
        $this->array =  ASCIIArray::generateRandomArray($this->from, $this->to);
        $this->removedElement = null;
    }

    public function testArrayAsciiToInt()
    {
        $array =  ASCIIArray::generateArray('A', 'C');
        $array =  ASCIIArray::arrayASCIIToInt($array);

        $this->assertEquals($array, [65, 66, 67]);
    }

    public function testGenerateArray()
    {
        $array = ASCIIArray::generateArray($this->from, $this->to);
        $this->assertEquals($this->from, $array[0]);
        $this->assertEquals($this->to, $array[count($array) - 1]);
        $this->assertCount($this->expectedSize, $array);
    }

    public function testGenerateRandomArray()
    {
        $this->assertContains($this->from, $this->array);
        $this->assertContains($this->to, $this->array);
        $this->assertCount($this->expectedSize, $this->array);
    }

    public function testRemoveRandomElement()
    {
        ASCIIArray::removeRandomElement($this->array, $this->removedElement);
        $this->assertCount($this->expectedSize - 1, $this->array);
    }

    public function testFindMissingElementDefault()
    {
        ASCIIArray::removeRandomElement($this->array, $this->removedElement);
        $missingElement = ASCIIArray::findMissingElement($this->array, $this->from, $this->to);
        $this->assertEquals($missingElement, $this->removedElement);
    }

    public function testFindMissingElementUsingSum()
    {
        ASCIIArray::removeRandomElement($this->array, $this->removedElement);
        $missingElement = ASCIIArray::findMissingElementUsingSum($this->array, $this->from, $this->to);
        $this->assertEquals($missingElement, $this->removedElement);
    }

    public function testFindMissingElementUsingDiff()
    {
        ASCIIArray::removeRandomElement($this->array, $this->removedElement);
        $missingElement = ASCIIArray::findMissingElementUsingDiff($this->array, $this->from, $this->to);
        $this->assertEquals($missingElement, $this->removedElement);
    }
}
