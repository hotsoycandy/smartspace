<?php
    $userid = $_POST['userid'];
    $userpw = $_POST['userpw'];
    $username = $_POST['username'];
    $grade = $_POST['grade'];
    $cls = $_POST['cls'];
    $num = $_POST['num'];
    $chid = preg_match("/^[a-zA-Z0-9]{6,18}$/",$userid);
    if(!$chid){
        alert("아이디는 6~18자의 영문, 숫자 조합만 입력 가능합니다.");
        back();
    }
    $chpw = preg_match('/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[`~!@#$%^&*|\\\'\";:\/?]).{6,18}$/',$userpw);
    if(!$chpw){
        alert("비밀번호는 영문,숫자,일부 특수문자 조합의 6~18자로 이루어져야 합니다.");
        back();
    }
    $userpw = md5($userpw);
    $chname = preg_match("/^[\x{ac00}-\x{d7af}]{2,4}$/u",$username);
    if(!$chname){
        alert("이름은 한글 2~4자만 가능합니다.");
        back();
    }
    $chgr = preg_match("/^[1-3]$/",$grade);
    if(!$chgr){
        alert("뒤질래 씹쌔야");
        back();
    }
    $chcl = preg_match("/^[1-6]$/",$cls);
    if(!$chcl){
        alert("뒤질래 씹쌔야");
        back();
    }
    $chnum = preg_match("/^[1-9]([0-9])?$/",$num);
    if(!$chnum){
        alert("번호가 올바르지 않습니다.");
        back();
    }
    $sql = "SELECT * FROM user WHERE userid=:userid";
    $sth = $db->prepare($sql);
    $sth->bindValue(":userid",$userid);
    $sth->execute();
    if($sth->rowcount()>0){
        alert("이미 있는 아이디입니다.");
        back();
    }
    $sql = "SELECT * FROM user WHERE grade=:grade and cls=:cls and num=:num";
    $sth = $db->prepare($sql);
    $sth->bindValue(":grade",$grade);
    $sth->bindValue(":cls",$cls);
    $sth->bindValue(":num",$num);
    $sth->execute();
    if($sth->rowcount()>0){
        alert("이미 등록한 학생입니다.");
        back();
    }
    $sql = "INSERT INTO user SET ";
    $sql.= "userid=:userid, userpw=:userpw, ";
    $sql.= "username=:username, grade=:grade, ";
    $sql.= "cls=:cls, num=:num";
    $sth = $db->prepare($sql);
    $sth->bindValue(":userid",$userid);
    $sth->bindValue(":userpw",$userpw);
    $sth->bindValue(":username",$username);
    $sth->bindValue(":grade",$grade);
    $sth->bindValue(":cls",$cls);
    $sth->bindValue(":num",$num);
    $sth->execute();
    alert('회원가입 완료!\n승인이 완료되면 계정이 사용 가능합니다.');
    move('/');
?>