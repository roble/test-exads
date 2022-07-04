<?php

declare(strict_types=1);

namespace RenanRoble\Exads;

use Exads\ABTestData;

class ABTesting extends ABTestData
{

    const PRECISION_INT = 1;
    const PRECISION_DEC = 10;
    protected $promotionId;


    /**
     * Constructor
     *
     * @param  int $promotionId
     * @return void
     */
    public function __construct(int $promotionId)
    {
        $this->promotionId = $promotionId;
        parent::__construct($promotionId);
    }


    /**
     * Pick a random design
     * 
     * PRECISION_INT: 0 to 100% step of 1
     * PRECISION_DEC: 0.0 to 100.0% step of 0.1
     *
     * @param  mixed $precision Default PRECISION_INT, use PRECISION_DEC for decimal precision
     * @return array
     */
    public function pickRandomDesign(int $precision = self::PRECISION_INT): array
    {
        $chances = $this->generateChanceArray($precision);
        $randKey = array_rand($chances);
        $designId = $chances[$randKey];

        return $this->getDesign($designId);
    }

    /**
     * Generate an array with the chances of each design
     *
     * @param  mixed $precision
     * @return array
     */
    public function generateChanceArray(int $precision = self::PRECISION_INT): array
    {
        $designs = $this->getAllDesigns();
        $chances = [];

        foreach ($designs as $design) {
            $array =  array_fill(
                0,
                $design['splitPercent'] * $precision,
                $design['designId']
            );
            $chances = array_merge($chances, array_values($array));
        }

        return $chances;
    }

    /**
     * Get the promotion id
     *
     * @return int
     */
    public function getPromotionId(): int
    {
        return $this->promotionId;
    }

    /**
     * Get design Url
     *
     * @param  string $designId
     * @return string
     */
    public function getDesignUrl(int $designId): string
    {
        return "/?page=show-design&id={$designId}&promoId={$this->getPromotionId()}";
    }
}
