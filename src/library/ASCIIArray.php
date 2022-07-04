<?php

declare(strict_types=1);

namespace RenanRoble\Exads;

use InvalidArgumentException;

class ASCIIArray
{

    const MODE_SUM = 'sum';
    const MODE_ARRAY_DIFF = 'array_diff';

    /**
     * Generate an array with ASCII elements
     *
     * @param  string $from ASCII character from
     * @param  string $to ASCII character to
     * @return array
     */
    static function generateArray(string $from, string $to): array
    {
        $charCodeFrom =  ord($from);
        $charCodeTo = ord($to);

        if ($charCodeTo - $charCodeFrom <= 0)
            throw new InvalidArgumentException("Invalid ASCII character range", 1);

        $array = [];

        for ($i = $charCodeFrom; $i <= $charCodeTo; $i++) {
            $array[] = chr($i);
        }

        return $array;
    }

    /**
     * Generate an array with random ASCII elements
     *
     * @param  string $from ASCII character from
     * @param  string $to ASCII character to
     * @return array
     */
    static function generateRandomArray(string $from, string $to): array
    {
        $array = self::generateArray($from, $to);
        shuffle($array);
        return $array;
    }

    /**
     * Remove a random element from an array
     *
     * @param  array $array 
     * @param  string $removedElement
     * @return array the modified array
     */
    static function removeRandomElement(array &$array, string &$removedElement = null): array
    {

        if (empty($array)) return $array;

        $index = rand(0, count($array) - 1);
        $removedElement = $array[$index];

        unset($array[$index]);

        return $array;
    }

    /**
     * Convert a ASCII array to int array
     *
     * @param  array $array
     * @return array
     */
    static function arrayASCIIToInt(array $array): array
    {
        return array_map(fn ($el) => ord($el), $array);
    }


    /**
     * Find the missing element
     *
     * @param  array $array
     * @param  string $from
     * @param  string $to
     * @return string
     */
    static function findMissingElement(array $array, string $from, string $to, string $mode = self::MODE_SUM): string
    {

        // if the very first element isn't in the array return it
        if (!in_array($from, $array)) return $from;
        // if the very last element isn't in the array return it
        if (!in_array($to, $array)) return $to;

        switch ($mode) {
            case self::MODE_ARRAY_DIFF:
                return self::findMissingElementUsingDiff($array, $from, $to);
            case self::MODE_SUM:
            default:
                return self::findMissingElementUsingSum($array, $from, $to);
                break;
        }
    }

    /**
     * Find the missing element using SUM
     *
     * @param  array $array
     * @param  string $from
     * @param  string $to
     * @return string
     */
    static function findMissingElementUsingSum(array $array, string $from, string $to): string
    {

        // if the very first element isn't in the array return it
        if (!in_array($from, $array)) return $from;
        // if the very last element isn't in the array return it
        if (!in_array($to, $array)) return $to;

        $arrayCharCode = self::arrayASCIIToInt($array);

        $sum = array_sum($arrayCharCode);
        $min = min($arrayCharCode);
        $max = max($arrayCharCode);

        $total = 0;

        for ($i = $min; $i <= $max; $i++)
            $total += $i;

        $rest = $total - $sum;

        return chr($rest);
    }

    /**
     * Find the missing element using DIFF
     *
     * @param  array $array
     * @param  string $from
     * @param  string $to
     * @return string
     */
    static function findMissingElementUsingDiff(array $array, string $from, string $to): string
    {
        $originalArray = self::generateArray($from, $to);
        $diff = array_diff($originalArray, $array);

        return array_shift($diff);
    }
}
