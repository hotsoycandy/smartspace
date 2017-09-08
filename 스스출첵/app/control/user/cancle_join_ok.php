<?php
    if(isset($_POST['idx'])){
        $idx = $_POST['idx'];
    }else{
        alert('비정상접근');
        move("/");
    }
    if(empty($_SESSION['allow'])$_SESSION['allow']!=2){
        alert('관지자 등금만 접근 가능합니다.');
        move("/");
    }
    $sql = "DELETE FROM SET WHERE idx=:idx";
    $sth = $db->prepare($sql);
    $sth->bindValue(":idx",$idx);
    $sth->execute();
    back();
?>