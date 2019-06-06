<?php

namespace App\Core\Infrastructure\Persistence\Doctrine;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver;
use Doctrine\DBAL\Driver\PDOSqlite\Driver as PDOSqlite;
use Exception;

class ConnectionManager
{
    private static $connectionForCreatingDatabases;

    public static function dropAndCreateDatabase(): void
    {
        if (self::$connectionForCreatingDatabases === null) {
            self::$connectionForCreatingDatabases = new Connection([
                'user' => self::getUser(),
                'password' => self::getPassword(),
                'host' => self::getHost(),
            ], self::getDriver());
        }
        self::$connectionForCreatingDatabases->exec(sprintf('DROP DATABASE IF EXISTS %s', self::getDbName()));
        self::$connectionForCreatingDatabases->exec(sprintf('CREATE DATABASE %s', self::getDbName()));
    }

    private static function getUser(): ?string
    {
        return $GLOBALS['DB_USER'] ?? null;
    }

    private static function getPassword(): ?string
    {
        return $GLOBALS['DB_PASSWORD'] ?? null;
    }

    private static function getHost(): ?string
    {
        return $GLOBALS['DB_HOST'] ?? null;
    }

    private static function getDriver(): Driver
    {
        if (!isset($GLOBALS['DB_DRIVER'])) {
            throw new Exception('Please set DB_DRIVER in global config');
        }
        if ($GLOBALS['DB_DRIVER'] === 'pdo_pgsql') {
            return new PDOSqlite();
        }

        throw new Exception(sprintf('DB_DRIVER "%s" not supported', $GLOBALS['DB_DRIVER']));
    }

    private static function getDbName(): string
    {
        if (!isset($GLOBALS['DB_DBNAME'])) {
            throw new Exception('Please set DB_DBNAME in global config');
        }

        return $GLOBALS['DB_DBNAME'];
    }

    public static function createConnection(): Connection
    {
        return new Connection([
            'user' => self::getUser(),
            'password' => self::getPassword(),
            'dbname' => self::getDbName(),
            'host' => self::getHost(),
        ], self::getDriver());
    }

    public static function createSqliteMemoryConnection(): Connection
    {
        return new Connection([
            'memory' => true,
        ], new PDOSqlite());
    }
}
