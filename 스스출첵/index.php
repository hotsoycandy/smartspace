<?php
    session_start();
    date_default_timezone_set('Asia/Seoul');
    if(isset($_GET['param']))
    $get = explode("/",$_GET['param']);
    $dir1 = isset($get[0]) ? $get[0] : null;
    $dir2 = isset($get[1]) ? $get[1] : null;
    $page = isset($get[2]) ? $get[2] : null;
    if($dir1 == null || $dir2 == null || $page == null){
        $dir1 = "view";
        $dir2 = "view";
        $page = "home";
    }
    require_once($_SERVER['DOCUMENT_ROOT']."/app/control/server/dbcon.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/app/control/server/lib.php");
    if($dir1 != "view"){
        if(empty($_POST['token'])||empty($_SERVER['HTTP_REFERER'])){
            alert("비정상접근");
            move('/');
        }else{
            if(empty($_SESSION['token'])){
                alert("비정상접근");
                move('/');
            }
            $token = $_POST['token'];
            if($token!=$_SESSION['token']){
                alert("비정상접근");
                move('/');
            }
        }
    }
    unset($_SESSION['token']);
    if($dir1 == "view")
        require_once($_SERVER['DOCUMENT_ROOT']."/app/temp/header.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/app/{$dir1}/{$dir2}/{$page}.php");
    if($dir1 == "view")
        require_once($_SERVER['DOCUMENT_ROOT']."/app/temp/footer.php");
?>