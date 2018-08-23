<?php

require_once "C:\workspace\board\config\config.php";

function insertMember($email, $nickname, $pw){

    $pwHash = password_hash($pw, PASSWORD_DEFAULT, ['cost'=> 11]);
    $sql = "INSERT INTO member
    (email, 
    nickname, 
    pw)
VALUES
    (?, 
     ?, 
     ?)";

    $stmt = MysqlConFig::getPrePare($sql);
    $stmt->bindValue(1, $email, PDO::PARAM_STR);
    $stmt->bindValue(2, $nickname, PDO::PARAM_STR);
    $stmt->bindValue(3, $pwHash, PDO::PARAM_STR);
    $stmt->execute();
}


function getMember($email){

    $sql = "SELECT * FROM member WHERE email=?";
    $result = null;
    $stmt = MysqlConFig::getPrePare($sql);
    $stmt->bindValue(1, $email, PDO::PARAM_STR);
     $stmt->execute();
     return $stmt->fetchAll();
}



?>