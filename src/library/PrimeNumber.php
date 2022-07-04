<?php

declare(strict_types=1);

namespace RenanRoble\Exads;

use InvalidArgumentException;

class PrimeNumber
{
    /**
     * Check whether a given number is prime or not
     *
     * @param  int $number
     * 
     * @return bool
     */
    static function isPrime(int $number): bool
    {
        if ($number <= 1)
            return false;

        for ($i = 2; $i <= sqrt($number); $i++)
            if ($number % $i === 0)
                return false;

        return true;
    }

    /**
     * Get all multiples of a given number
     *
     * @param  mixed $number
     * @return array
     */
    static function getMultiples(int $number): array
    {
        $multiples = [1];

        if ($number === 1)
            return $multiples;

        for ($i = 2; $i <= $number / 2; $i++)
            if ($number % $i === 0)
                $multiples[] = $i;

        $multiples[] = $number;

        return $multiples;
    }

    /**
     * Format number with PRIME or its multiples
     *
     * @param  int $number
     * @return string
     */
    static function formatPrimeOrMultiple(int $number): string
    {
        if ($number <= 0)
            throw new InvalidArgumentException('The number must be greater than zero');

        $multiples = self::getMultiples($number);
        $output = self::isPrime($number)
            ? 'PRIME'
            : implode(',', $multiples);

        return sprintf("%s - [%s]", $number, $output);
    }
}
