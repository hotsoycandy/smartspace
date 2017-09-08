<!--library is connected-->
<?php
    function back(){
        exit(scripts('history.back();'));
    }
    function alert($txt){
        scripts("alert('{$txt}')");
    }
    function scripts($src){
        echo "<script>{$src}</script>";
    }
    function move($url){
        exit(scripts("location.replace('{$url}');"));
    }
?>