<?php

declare(strict_types=1);

namespace RenanRoble\Exads;

use PHPUnit\Framework\TestCase;



final class ModelTest extends TestCase
{

    private $class;

    protected function setUp(): void
    {
        require __DIR__ . '/config.php';

        $this->class = new class extends Model
        {
            protected static $casts = ['release_date' => 'datetime'];
            public static string $table = 'tv_series';
        };
    }

    public function testGetInstance(): void
    {
        $this->assertInstanceOf(get_class($this->class), $this->class::getInstance());
    }

    public function testRunQuery(): void
    {
        $this->assertIsArray(
            $this->class::getInstance()
                ->query('SELECT * FROM tv_series LIMIT 5')
        );
    }

    public function testCastDateTime(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => 'The Simpsons',
                'release_date' => '1989-12-17',
            ]
        ];

        $this->assertInstanceOf(
            'DateTime',
            $this->class::cast($data)[0]['release_date']
        );
    }
}
