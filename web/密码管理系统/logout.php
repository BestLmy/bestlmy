<?php
    require_once('main.php');
    if(isset($_SESSION["uid"])&&isset($_SESSION["id"])){
    unset($_SESSION['id']);
    unset($_SESSION['uid']);
    die("安全退出成功！<meta   http-equiv ='refresh' content=1;url=$url1>");
    }else die("尚未登录，无法注销！<meta   http-equiv ='refresh' content=1;url=$url1>");
?>