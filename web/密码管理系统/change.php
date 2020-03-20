<?php
require_once('main.php');
if(isset($_GET["type"])&&isset($_GET["imp"])){
    $type=$_GET["type"];
    $imp=$_GET["imp"];
if(isset($_GET["account"])){
    $acc=$_GET["account"];
    $changesql="update passwd set account='".$acc."' where uid='".$uid."' and type='".$type."'and importance=".$imp;
    $result=mysqli_query($conn,$changesql);
    if(mysqli_affected_rows($conn)==1){
        die("<script>alert('账号修改成功!');</script><meta   http-equiv ='refresh' content=0;url=main.php?type=$type>");
    }else die("<meta   http-equiv ='refresh' content=0;url=main.php?type=$type>");
}elseif(isset($_GET['passwd'])){
    $acc=$_GET["accoun"];
    $pass=$_GET["passwd"];
    $changesql="update passwd set password=(AES_ENCRYPT('".$pass."','abc')) where uid='".$uid."' and type='".$type."' and account='".$acc."'and importance=".$imp;
    $result=mysqli_query($conn,$changesql);
    if(mysqli_affected_rows($conn)==1){
        die("<script>alert('密码修改成功!');</script><meta   http-equiv ='refresh' content=0;url=main.php?type=$type>");
    }else die("<script>alert('密码修改失败!');</script><meta   http-equiv ='refresh' content=0;url=main.php?type=$type>");
}elseif(isset($_GET["note"])){
    $note=$_GET["note"];
    $acc=$_GET["accoun"];
    $changesql="update passwd set note='".$note."' where uid='".$uid."' and type='".$type."' and account='".$acc."'and importance=".$imp;
    $result=mysqli_query($conn,$changesql);
    if(mysqli_affected_rows($conn)==1){
        die("<script>alert('留言修改成功!');</script><meta   http-equiv ='refresh' content=0;url=main.php?type=$type>");
    }else die("<meta   http-equiv ='refresh' content=0;url=main.php?type=$type>");
}
}else die("缺少参数!");
?>