<?php

class Db
{
    /***
     * @var PDO $connection
     */
    private static $connection;

    public static function Init(string $host, string $user, string $pass, string $db): void
    {
        try {
            self::$connection = new PDO('mysql:host=' . $host . ';dbname=' . $db . ';charset=utf8', $user, $pass);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $ex) {
            self::Error($ex);
        }
    }

    public static function Scape($string): bool|string
    {
        $quoted= self::$connection->quote($string);
        return substr($quoted, 1, -1);

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
