<?php
    $host="localhost";
    $dbname="ss";
    $userid="root";
    $userpw="";
    $dsn="mysql:host={$host}; dbname={$dbname}; charset=utf8";
    try{
        $db = new PDO($dsn,$userid,$userpw);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,PDO::ERRMODE_EXCEPTION);
        print "<!--database is connected-->\n";
    }
    catch(PDOException $e){ //에러의 정보를 $e에 저장
        print "<!--database is not connected : ".$e->getMessage()."-->\n";
    }
?>