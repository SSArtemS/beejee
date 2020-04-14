<?php

class Db
{
    public static function getConnection()
    {
        $paramsPath = ROOT . '/config/dbconnect.php';
        $params = include($paramsPath);

        $dbn = "mysql: host={$params['host']}, dbname={$params['dbname']}";
        $db = new PDO($dbn, $params['user'], $params['password']);

        $db = false;

        try {
            $db = new PDO($dbn, $params['user'], $params['password']);
        } catch (PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
        }

        return $db;
    }
}


