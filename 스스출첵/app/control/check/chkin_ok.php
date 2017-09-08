<?php
    if(empty($_SESSION['userid'])||$_SESSION['userid']==null||$_SESSION['userid']==""){
        move('/');
    }
    if(empty($_SESSION['username'])||$_SESSION['username']==null||$_SESSION['username']==""){
        move('/');
    }
    $userid = $_SESSION['userid'];
    $username = $_SESSION['username'];
    /*출근상태*/
    $sql = "UPDATE user SET attend=1 WHERE userid=:userid";
    $sth = $db->prepare($sql);
    $sth->bindValue(":userid",$userid);
    $sth->execute();
    
    /*출근기록*/
    $now = date("Y-m-d H:i:s");
    $sql = "INSERT INTO ttable SET start=:now, end='1999-09-09 09:09:09', username=:username";
    $sth = $db->prepare($sql);
    $sth->bindValue(":now",$now);
    $sth->bindValue(":username",$username);
    $sth->execute();

    $_SESSION['time'] = $now;
    move('/');
?>