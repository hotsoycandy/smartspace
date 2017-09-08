<?php
    if(empty($_GET['year']))
        $year = date("Y");
    else
        $year = $_GET['year'];
    if(empty($_GET['month']))
        $month = date("m");
    else{
        $month = $_GET['month'];
        if($month<10)
            $month = "0".$month;
    }
    if(empty($_GET['day']))
        $day = date("d");
    else{
        $day = $_GET['day'];
        if($day<10)
            $day = "0".$day;
    }
    $date = $year.$month.$day;
    $sql = "SELECT * FROM absent WHERE wdate=:date";
    $sth = $db->prepare($sql);
    $sth->bindValue(":date",$date);
    $sth->execute();
?>
<h2>결근</h2>
<table>
    <tr>
        <th>이름</th>
        <th>날짜</th>
    </tr>
    <?php
        if($sth->rowcount()==0){
    ?>
        <tr>
            <td colspan="2">기록 없음</td>
        </tr>
    <?php
        }
        foreach($sth as $row){
    ?>
    <tr>
        <td><?=$row['username']?></td>
        <td><?=$row['wdate']?></td>
    </tr>
    <tr>
        <td colspan="2" class="reason"><?=$row['reason']?></td>
    </tr>
    <?php } 
        $date = $year."-".$month."-".$day;
        $sql = "SELECT * FROM ttable WHERE start > :start and start < :end";
        $sth = $db->prepare($sql);
        $sth->bindValue(":start",date($date." 00:00:00"));
        $sth->bindValue(":end",date($date." 23:59:59"));
        $sth->execute();
    ?>
</table>
<h2>출근/퇴근</h2>
<table>
    <tr>
        <th>이름</th>
        <th>출근</th>
        <th>퇴근</th>
    </tr>
    <?php
        if($sth->rowcount()==0){
    ?>
        <tr>
            <td colspan="4">기록 없음</td>
        </tr>
    <?php
        }
        foreach($sth as $row){
    ?>
    <tr>
        <td width='80'><?=$row['username']?></td>
        <td><?=$row['start']?></td>
        <td><?php
            if($row['end']=="1999-09-09 09:09:09")
                echo "아직 퇴근 안함";
            else
                echo $row['end'];
        ?></td>
    </tr>
    <?php } ?>
</table>
<a href="/"><button class="lbtn">돌아가기</button></a>