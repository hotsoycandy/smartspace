<?php
    $userid = $_POST['userid'];
    $userpw = $_POST['userpw'];
    $chid = preg_match("/^[a-zA-Z]\w{6,18}$/u",$userid);
    if(!$chid){
        alert("아이디 또는 비밀번호를 다시 입력해주세요");
        back();
    }
    $chpw = preg_match('/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[`~!@#$%^&*|\\\'\";:\/?]).{8,20}$/',$userpw);
    if(!$chpw){
        alert("아이디 또는 비밀번호를 다시 입력해주세요");
        back();
    }
    $userpw = md5($userpw);
    $sql = "SELECT * FROM user WHERE userid=:userid and userpw=:userpw";
    $sth = $db->prepare($sql);
    $sth->bindValue(":userid", $userid);
    $sth->bindValue(":userpw", $userpw);
    $sth->execute();
    if($sth->rowcount()>0){
        $row = $sth->fetch();
        if($row['allow']==0){
            alert('아직 허락되지 않은 계정입니다.\n관리자에게 문의하세요');
            move('/');
        }
        $_SESSION['userid'] = $row['userid'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['allow'] = $row['allow'];
        move('/');
    }else{
        alert("아이디 또는 비밀번호를 다시 입력해주세요");
        move('/');
    }
?>