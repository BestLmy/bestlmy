<?php
require_once('main.php');
if(isset($_GET["account"])&&isset($_GET["type"]))
{
    $account=$_GET["account"];
	$type=$_GET["type"];
    $delsql="delete from passwd where uid=".$uid." and account='".$account."'and type='".$type."'";
    $result=mysqli_query($conn,$delsql);
    if(mysqli_affected_rows($conn)==1){
        die("<script>alert('删除成功!');</script><meta   http-equiv ='refresh' content=0;url=main.php?type={$_GET['type']}>");
    }
}else die("wrong");
?>