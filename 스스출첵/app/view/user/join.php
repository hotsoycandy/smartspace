<?php
    $token = microtime();
    $_SESSION['token'] = $token;
?>
<form action="/control/user/join_ok" method="post">
    <input type="hidden" value="<?=$token?>" name="token">
    <div class="fw">
        <input type="text" id="user_id" class="inp ui" name="userid" placeholder="아이디" required>
        <input type="password" id="user_pw" class="inp up" name="userpw" placeholder="비밀번호" required>
        <input type="text" id="user_pw" class="inp up" name="username" placeholder="이름" required>
        <div class="cls">
            <div class="gcnw">
                <select name="grade" id="grade" class="gcn">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
                <label for="grade" class="gcnl">학년</label>
            </div>
            <div class="gcnw">
                <select name="cls" id="cls" class="gcn">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
                <label for="cls" class="gcnl">반</label>
            </div>
            <div class="gcnw">
                <input type="number" class="gcn" value="0" name="num" min="1" max="30"><label for="" class="gcnl">번</label>
            </div>
        </div>
        <div class="bw">
            <a href="/"><button type="button" class="btn j_back">돌아가기</button></a>
            <button type="submit" class="btn j_join">회원가입</button>
        </div>
    </div>
</form>