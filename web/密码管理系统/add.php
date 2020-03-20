<?php
require_once('main.php');
if(isset($uid)&&isset($_GET["type"])&&isset($_GET["account"])){
    $pass="aa";
    $type="aa";
    $note="aa";
    $account="aa";
    $type=$_GET["type"];
    $account=$_GET["account"];
    if(isset($_GET["note"]))    $note=$_GET["note"];
    if(isset($_GET["pass"]))     $pass=$_GET["pass"];
    $addsql="INSERT into passwd VALUES (".$uid.",'".$account."',(AES_ENCRYPT('".$pass."','abc')),'".$type."','".$note."',4);";
    $result=mysqli_query($conn,$addsql);
    if(mysqli_affected_rows($conn)==1){
        die("<script>alert('添加成功!');</script><meta   http-equiv ='refresh' content=0;url=main.php?type=$type>");
    }
}else{
    die("<script>alert('少参数!');</script><meta   http-equiv ='refresh' content=0;url=main.php>");
}
?>