<?php

class DB
{

    /**
     * Gets connection with DB
     *
     * @param $params - parameters for connection to DB
     *
     * @return PDO object for connection with DB
     */
    public static function getConnection($params)
    {
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";

        $db = new PDO($dsn, $params['user'], $params['password']);
        $db->exec("set names utf-8");

        return $db;
    }

}
