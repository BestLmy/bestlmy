<?php
require_once "./dbConfig.php";
if($flag==1){
header('Content-type:text/html; charset=utf-8');
if(isset($_POST["phone"])&&isset($_POST["account1"])&&isset($_POST["pwd0"])&&isset($_POST["pwd1"])){
    $phone=$_POST["phone"];
    $user_account=$_POST["account1"];
    $pwd=md5($_POST["pwd0"]);
    if(is_numeric($phone)&&strlen($phone)==11){
	$sql="SELECT user_phonenum FROM `user` where user_account='$user_account'";
    $result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $data=$row["user_phonenum"];
    if($data==$phone){
        if($_POST["pwd0"]===$_POST["pwd1"]){
            $sql="UPDATE user SET user_pwd='$pwd' WHERE user_account='$user_account'";
            $result=mysqli_query($conn,$sql);
            echo "<script>alert('修改成功!')</script>";
            die("<meta   http-equiv ='refresh' content=0;url=index.html>");
        }else {
            echo "<script>alert('两次输入的密码不匹配!')</script>";
            die("<meta   http-equiv ='refresh' content=0;url='forget.html'>");
        }
    }else{
        die("<script>alert('手机号不匹配！')</script><meta   http-equiv ='refresh' content=0;url=forget.html>");
        }
    }else die("输入数据错误！<meta   http-equiv ='refresh' content=0;url='forget.html'>");
}else die("<meta   http-equiv ='refresh' content=0;url='forget.html'>");
}else die("服务器错误:数据库连接失败");
?>