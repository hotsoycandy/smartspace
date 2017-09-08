<?php
    if(empty($_SESSION['userid'])||$_SESSION['userid']==""){
        move('/');
    }
    if(empty($_SESSION['username'])||$_SESSION['username']==""){
        move('/');
    }
    $date = date("Y-m-d");
    $userid = $_SESSION['userid'];
    $sql = "delete from absent ";
    $sql.= "where userid=:userid ";
    $sql.= "and wdate = :date ";
    $sql.= "order by wdate desc limit 1";
    $sth = $db->prepare($sql);
    $sth->bindValue(":userid",$userid);
    $sth->bindValue(":date",$date);
    $sth->execute();
    move('/');
?>