<?php

declare(strict_types=1);

namespace RenanRoble\Exads;

use PHPUnit\Framework\TestCase;
use RenanRoble\Exads\ABTesting;

final class ABTestingTest extends TestCase
{
    private $promotion;

    protected function setUp(): void
    {
        $id = rand(1, 3);
        $this->promotion = new ABTesting($id);
    }

    public function testPickRandomDesign(): void
    {
        $design = $this->promotion->pickRandomDesign();
        $this->assertIsArray($design);
        $this->assertArrayHasKey('designId', $design);
        $this->assertArrayHasKey('designName', $design);
        $this->assertArrayHasKey('splitPercent', $design);
    }

    public function testGetAllDesigns(): void
    {
        $designs = $this->promotion->getAllDesigns();
        $this->assertIsArray($designs);
        $this->assertArrayHasKey('designId', $designs[0]);
        $this->assertArrayHasKey('designName', $designs[0]);
        $this->assertArrayHasKey('splitPercent', $designs[0]);
    }

    public function testGetPromotionId(): void
    {
        $id = $this->promotion->getPromotionId();
        $this->assertIsInt($id);
    }

    public function testGetDesignUrl(): void
    {
        $url = $this->promotion->getDesignUrl(1);
        $this->assertIsString($url);
    }

    public function testGetDesign(): void
    {
        $design = $this->promotion->getDesign(1);
        $this->assertIsArray($design);
        $this->assertArrayHasKey('designId', $design);
        $this->assertArrayHasKey('designName', $design);
        $this->assertArrayHasKey('splitPercent', $design);
    }

    public function testGenerateChanceArray(): void
    {
        $chances = $this->promotion->generateChanceArray();
        $this->assertIsArray($chances);
        $this->assertCount(100, $chances);
    }

    public function testGenerateChanceArrayDecimalPrecision(): void
    {
        $chances = $this->promotion->generateChanceArray(ABTesting::PRECISION_DEC);
        $this->assertIsArray($chances);
        $this->assertCount(1000, $chances);
    }
}
