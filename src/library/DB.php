<?php

declare(strict_types=1);

namespace RenanRoble\Exads;

use PDO;
use PDOStatement;
use RenanRoble\Exads\DB\DriverInterface;
use RenanRoble\Exads\DB\MySQLDriver;

final class DB
{

    protected static $instance;
    protected $pdo;


    /**
     * __construct
     *
     * @param  DriverInterface $driverClass
     * @return void
     */
    public function __construct(DriverInterface $driverClass)
    {
        $dsn = $driverClass->getDsn();

        $options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION
        ];

        $this->pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
    }


    /**
     * Return the Database instance
     *
     * @param  DriverInterface $driverClass Default MySQLDriver
     * @return self
     */
    public static function getInstance($driverClass = MySQLDriver::class): self
    {
        if (!self::$instance)
            self::$instance = new self(new $driverClass);
        return self::$instance;
    }

    /**
     * Run the query with or without parameters
     *
     * @param  string $query
     * @param  array $params
     * @return PDOStatement
     */
    public function run($query, $params = [])
    {
        if (empty($params))
            return $this->query($query);

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    /**
     * Call native PDO methods
     */
    public function __call($method, $params)
    {
        return call_user_func_array(array($this->pdo, $method), $params);
    }
}
