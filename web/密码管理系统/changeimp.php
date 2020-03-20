<?php
include_once('main.php');
//type,account,pass,imp
if(isset($_GET["imp"])&&isset($_GET["account"])&&isset($_GET["type"])&&isset($_GET["pass"]))
{
    $imp=$_GET["imp"];
    $account=$_GET["account"];
    $type=$_GET["type"];
    $pass=$_GET["pass"];
    $changeimpsql="update passwd set importance=".$imp." where uid=".$uid." and type='".$type."' and account='".$account."'";
    $result=mysqli_query($conn,$changeimpsql);
    if(mysqli_affected_rows($conn)==1){
        die("<script>alert('修改成功!');</script><meta   http-equiv ='refresh' content=0;url=main.php?type={$_GET['type']}>");
    }
}else die("<script>alert('参数错误')</script>");
?>