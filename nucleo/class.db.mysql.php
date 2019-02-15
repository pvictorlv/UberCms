<?php

class Db
{
    /***
     * @var PDO $connection
     */
    private static $connection;

    public static function Init(array $config): void
    {
        try {
            self::$connection = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['db'] . ';charset=utf8', $config['user'], $config['pass']);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $ex) {
            self::Error($ex);
        }
    }

    public static function Error($errorString): void
    {
        uberCore::SystemError('Database Error', $errorString);
    }

    public static function GetId(): int
    {
        return (int)self::$connection->lastInsertId();
    }

    public static function DoQuery($query): \PDOStatement
    {
        return self::$connection->query($query);
    }

    public static function fastQuery(string $sql): void
    {
        self::$connection->exec($sql);
    }

    public static function query(string $sql, ...$params): \PDOStatement
    {
        $prep = self::$connection->prepare($sql);
        $prep->execute($params);
        return $prep;
    }
}
