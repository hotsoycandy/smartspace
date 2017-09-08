<?php
    $token = microtime();
    $_SESSION['token'] = $token;
    if(isset($_SESSION['userid'])&&$_SESSION['userid']!=null){
        $sql = "select attend from user where userid=:userid";
        $sth = $db->prepare($sql);
        $sth->bindValue(":userid",$_SESSION['userid']);
        $sth->execute();
        $attend = $sth->fetch()['attend'];
        if($attend==1){
            $att = "출근";
            $btn = "퇴근하기";
            $alink = "/control/check/chkout_ok";
        }
        else{
            $att = "퇴근";
            $btn = "출근하기";
            $alink = "/control/check/chkin_ok";
        }
        /*absent check*/
        $date = date("Y-m-d");
        $sql = "select * from absent ";
        $sql.= "where userid=:userid ";
        $sql.= "and wdate = :date ";
        $sql.= "order by wdate desc limit 1";
        $sth = $db->prepare($sql);
        $sth->bindValue(":userid",$_SESSION['userid']);
        $sth->bindValue(":date",$date);
        $sth->execute();
        $absent = $sth->rowcount();
        if($absent){
            $att = "결근";
            $btn = "결근취소";
            $alink = "/control/absent/absent_out_ok";
        }
?>
<div class="logbox">
    <?=$_SESSION['username']?>님 환영합니다!<br><br>
    지금 상태 : <?=$att?>
    <div class="bw">
        <form action="/control/login/logout_ok" method="post">
            <input type="hidden" value="<?=$token?>" name="token">
            <button type="submit" class="btn i_join">로그아웃</button>
        </form>
        <form action="<?=$alink?>" method="post">
            <input type="hidden" value="<?=$token?>" name="token">
            <button type="submit" class="btn i_login"><?=$btn?></button>
        </form>
    </div>
</div>
<a href="/view/view/attdetail"><button class="lbtn">오늘 출근 현황</button></a>
<a href="/view/view/attcal"><button class="lbtn">달력 보기</button></a>
<div id="absent_box" class="absent_box">
    <h2>결근 사유</h2>
    <form action="/control/absent/absent_in_ok" method="post" id="absent_form">
        <textarea name="reason" id="absent_txt" class="absent_txt" cols="30" rows="10"></textarea>
        <input type="hidden" value="<?=$token?>" name="token">
    </form>
    <button id="absent_cal" class="absent_cal">최소하기</button>
</div>
<?php
    if(!$absent){
?>
<button id="absent" class="lbtn">결근 신청</button>
<?php
    }
    if($_SESSION['allow']==2){
?>
<a href="/view/user/allow_join"><button class="lbtn">가입 승인 목록</button></a>
<?php        
    }
    }else{
?> 
<form action="/control/login/login_ok" method="post">
    <div class="fw">
        <input type="text" id="userid" class="inp ui" name="userid" placeholder="아이디">
        <input type="password" id="userpw" class="inp up" name="userpw" placeholder="비밀번호">
        <div class="bw">
            <a href="/view/user/join"><button type="button" class="btn i_join">회원가입</button></a>
            <button type="submit" class="btn i_login">로그인</button>
        </div>
        <input type="hidden" value="<?=$token?>" name="token">
    </div>
</form>
<?php
    }
?>