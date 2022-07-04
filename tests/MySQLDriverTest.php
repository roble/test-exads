<?php

declare(strict_types=1);

namespace RenanRoble\Exads\DB;

use PHPUnit\Framework\TestCase;
use RenanRoble\Exads\DB\MySQLDriver;

final class MySQLDriverTest extends TestCase
{

    protected function setUp(): void
    {
        require __DIR__ . '/config.php';
    }

    public function testGetDsn(): void
    {
        $driver = new MySQLDriver();

        $this->assertIsString($driver->getDSN());
        $this->assertStringContainsString('mysql:host=', $driver->getDSN());
    }
}
