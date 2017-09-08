<?php
    if(empty($_SESSION['userid'])||$_SESSION['userid']==null||$_SESSION['userid']==""){
        move('/');
    }
    if(empty($_SESSION['username'])||$_SESSION['username']==null||$_SESSION['username']==""){
        move('/');
    }
    $username = $_SESSION['username'];
    $sql = "UPDATE user SET attend=0 WHERE username=:username";
    $sth = $db->prepare($sql);
    $sth->bindValue(":username",$username);
    $sth->execute();

    $sql = "UPDATE ttable SET end=now() where username=:username order by start desc limit 1";
    $sth = $db->prepare($sql);
    $sth->bindValue(":username",$username);
    $sth->execute();
    move('/');
?>