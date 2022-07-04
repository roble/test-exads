<?php

declare(strict_types=1);

namespace App\Models;

use PHPUnit\Framework\TestCase;
use App\Models\TVSeries;


final class TVSeriesTest extends TestCase
{

    protected function setUp(): void
    {
        require __DIR__ . '/config.php';
    }

    public function testSelectAll(): void
    {
        $data = TVSeries::getInstance()
            ->query('SELECT * FROM tv_series LIMIT 5');

        $this->assertIsArray($data);
        $this->assertCount(5, $data);
    }

    public function testGetNextWillAir(): void
    {
        $data = TVSeries::getNextWillAir();
        $this->assertArrayHasKey('id', $data[0]);
        $this->assertArrayHasKey('title', $data[0]);
        $this->assertArrayHasKey('gender', $data[0]);
        $this->assertArrayHasKey('channel', $data[0]);
        $this->assertArrayHasKey('next_show_time', $data[0]);
        $this->assertInstanceOf('DateTime', $data[0]['next_show_time']);
    }

    public function testGetNextWillAirFilterByTitle(): void
    {
        $data = TVSeries::getNextWillAir('', 'robot');
        $this->assertNotEmpty($data[0]);
        $title  = $data[0]['title'];
        $this->assertStringContainsString('Robot', $title);
    }

    public function testGetNextWillAirFilterBeforeNow(): void
    {
        $data = TVSeries::getNextWillAir('2022-01-01');
        $this->assertCount(0, $data);
    }

    public function testGetNextWillAirFilterAfterNow(): void
    {
        $datetime = new \DateTime();
        $datetime->modify('+1 day');
        $data = TVSeries::getNextWillAir($datetime->format('Y-m-d H:i:s'));
        $this->assertGreaterThanOrEqual(1, count($data));
    }

    public function testGetNextWillAirDateFunction(): void
    {
        $datetime = new \DateTime();
        $datetime->modify('+1 day');

        $data = TVSeries::getNextWillAir($datetime->format('Y-m-d H:i:s'))[0];
        $this->assertIsArray($data);

        // MySQL week_day starts on 0 while PHP starts on 1, 
        // then subtract 1 to get the same result
        $current_week_day =  $datetime->format('N') - 1;

        if ($data['week_day'] - $current_week_day < 0) {
            $next_week_day = 7 +  $data['week_day'] - $current_week_day;
        } else {
            $next_week_day = $data['week_day'] - $current_week_day;
        }

        $datetime->modify("+{$next_week_day} day");

        $this->assertEquals(
            $data['next_show_time']->format('Y-m-d H:i:s'),
            $datetime->format('Y-m-d') . ' ' . $data['show_time']
        );
    }
}
