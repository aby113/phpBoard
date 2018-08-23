<?php

define('url', "mysql:host=localhost;dbname=web");
define('user', "bm");
define('pw', "bm");

class MysqlConFig
{

    // PrePareStatement객체 가져오기
    public static function getPrePare($sql): PDOStatement
    {
        try {
            $db = new PDO(url, user, pw);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            print $e->getMessage();
        }

        return $db->prepare($sql);
    }

    // 커넥션 가져오기
    public static function getConnection(): PDO
    {
        try {
            $db = new PDO(url, user, pw);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            print $e->getMessage();
        }

        return $db;
    }

}
