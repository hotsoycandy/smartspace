<?php
    if(empty($_SESSION['allow'])||$_SESSION['allow']!=2){
        alert("관리자 등급만 접근 가능합니다.");
        move("/");
    }
    $sql = "SELECT * FROM user WHERE allow=0";
    $sth = $db->prepare($sql);
    $sth->execute();
    $token = microtime();
    $_SESSION['token'] = $token;
?>
<table>
    <tr>
        <th>아이디</th>
        <th>이름</th>
        <th>학번</th>
        <th>승인</th>
    </tr>
    <?php
        if($sth->rowcount()==0){
    ?>
        <tr>
            <td colspan="4">승인 대기 목록 없음</td>
        </tr>
    <?php
        }
        foreach($sth as $row){
            if($row['num']<10)
                $num = "0".$row['num'];
            else
                $num = $row['num'];
    ?>
    <tr>
        <td><?=$row['userid']?></td>
        <td><?=$row['username']?></td>
        <td><?=$row['grade']?>0<?=$row['cls']?><?=$num?></td>
        <td>
            <form action="/control/user/allow_join_ok" method="post">
                <input type="hidden" name="idx" value="<?=$row['idx']?>">
                <input type="hidden" name="token" value="<?=$token?>">
                <button type="submit" id="allow">승인</button>
            </form>
            <form action="/control/user/cancle_join_ok" method="post">
                <input type="hidden" name="idx" value="<?=$row['idx']?>">
                <input type="hidden" name="token" value="<?=$token?>">
                <button type="submit" id="cancle">거부</button>
            </form>
        </td>
    </tr>
    <?php } ?>
</table>
<a href="/"><button class="lbtn">돌아가기</button></a>