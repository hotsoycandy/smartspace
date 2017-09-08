<?php
    if(empty($_SESSION['userid'])||$_SESSION['userid']==""){
        move('/');
    }
    if(empty($_SESSION['username'])||$_SESSION['username']==""){
        move('/');
    }
    if(empty($_POST['reason'])||$_POST['reason']==null||$_POST['reason']==""){
        move('/');
    }
    $userid = $_SESSION['userid'];
    $username = $_SESSION['username'];
    $reason = $_POST['reason'];

    $sql = "INSERT INTO absent SET reason=:reason, ";
    $sql.= "userid=:userid, username=:username, ";
    $sql.= "wdate = now()";
    $sth = $db->prepare($sql);
    $sth->bindValue(":reason",$reason);
    $sth->bindValue(":userid",$userid);
    $sth->bindValue(":username",$username);
    $sth->execute();
    $token = microtime();
    $_SESSION['token'] = $token;
    alert('결근 신청 완료\n만약 출근중이셨다면 강제 퇴근됩니다.');
?>
<form action="/control/check/chkout_ok" method="post" id="abform">
    <input type="hidden" value="<?=$token?>" name="token">
</form>
<script>
    document.getElementById("abform").submit();
</script>