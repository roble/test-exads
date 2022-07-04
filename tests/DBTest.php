<?php

declare(strict_types=1);

namespace RenanRoble\Exads;

use PHPUnit\Framework\TestCase;

final class DBTest extends TestCase
{

    protected function setUp(): void
    {
        require __DIR__ . '/config.php';
    }

    public function testGetInstance(): void
    {
        $this->assertInstanceOf(DB::class, DB::getInstance());
    }

    public function testRunQuery(): void
    {
        $this->assertInstanceOf(\PDOStatement::class, DB::getInstance()->run('SELECT * FROM tv_series LIMIT 5'));
    }

    public function testRunInvalidQuery(): void
    {
        $this->assertEquals(false, DB::getInstance()->run('SELECT * FROM an_invalid_table'));
    }

    public function testRunNativePdoMethod(): void
    {
        $this->assertIsArray(DB::getInstance()->run('SELECT * FROM tv_series LIMIT 5')->fetchAll());
    }
}
