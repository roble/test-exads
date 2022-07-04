<?php

declare(strict_types=1);

namespace RenanRoble\Exads;

use PHPUnit\Framework\TestCase;
use RenanRoble\Exads\PrimeNumber;
use InvalidArgumentException;

final class PrimeNumberTest extends TestCase
{
    public function testIsPrime()
    {
        $this->assertEquals(PrimeNumber::isPrime(0), false);
        $this->assertEquals(PrimeNumber::isPrime(1), false);
        $this->assertEquals(PrimeNumber::isPrime(2), true);
        $this->assertEquals(PrimeNumber::isPrime(37), true);
        $this->assertEquals(PrimeNumber::isPrime(73), true);
        $this->assertEquals(PrimeNumber::isPrime(97), true);
        $this->assertEquals(PrimeNumber::isPrime(100), false);
    }

    public function testisPrimeWithNegativeNumber()
    {
        $this->assertEquals(PrimeNumber::isPrime(-1), false);
    }

    public function testIsPrimeMultiples()
    {
        $multiples = PrimeNumber::getMultiples(1);
        $this->assertEquals($multiples, [1]);

        $multiples = PrimeNumber::getMultiples(100);
        $this->assertEquals($multiples, [1, 2, 4, 5, 10, 20, 25, 50, 100]);
    }

    public function testPrintPrimeOrMultiplesWithNegativeNumberThrowsException()
    {
        $this->expectException(InvalidArgumentException::class);

        PrimeNumber::formatPrimeOrMultiple(-1);
    }

    public function testPrintPrimeOrMultiples()
    {

        $this->assertEquals(PrimeNumber::formatPrimeOrMultiple(2), '2 - [PRIME]');
        $this->assertEquals(PrimeNumber::formatPrimeOrMultiple(20), '20 - [1,2,4,5,10,20]');
        $this->assertEquals(PrimeNumber::formatPrimeOrMultiple(100), '100 - [1,2,4,5,10,20,25,50,100]');
    }
}
