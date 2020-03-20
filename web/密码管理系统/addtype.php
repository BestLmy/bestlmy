<?php
require_once("main.php");
if(isset($_GET["type"])){
    $add_type=$_GET["type"];
    $sql="insert into passwd VALUES ('$uid','default',(AES_ENCRYPT('default','abc')),'$add_type','null',4)";
    $result=mysqli_query($conn,$sql);
    if(mysqli_affected_rows($conn)==1){
        die("<script>alert('添加成功!');</script><meta   http-equiv ='refresh' content=0;url=main.php?type=$add_type>");
    }else die("<script>alert('添加失败!');</script><meta   http-equiv ='refresh' content=0;url=main.php>");
}else die("<script>alert('没有设置类!');</script>");
?>