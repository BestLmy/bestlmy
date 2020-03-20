<?php
require_once "./dbConfig.php";
if($flag==1){
header('Content-type:text/html; charset=utf-8');
$phone=$_POST["phone"];
$user_account=$_POST["account1"];
$user_pwd=md5($_POST["pwd0"]);
if(is_numeric($phone)&&strlen($phone)==11){
	if($_POST["pwd0"]===$_POST["pwd1"]){

	$sql="INSERT INTO `pwd`.`user`(`user_account`, `user_pwd`, `user_phonenum`) VALUES ('$user_account', '$user_pwd', $phone)";
	$result=mysqli_query($conn,$sql);
	if(mysqli_affected_rows($conn)==1){
		echo "<script>alert('注册成功！')</script><meta   http-equiv ='refresh' content=0;url=index.html>";
	}else {
		echo "<script>alert('账号已存在！')</script><meta   http-equiv ='refresh' content=0;url=./register.html>";
		}
}else echo "两次输入的密码不一致";
}else echo "输入的手机号码格式错误，11位且都是数字";
}else echo "服务器错误:数据库连接失败";
?>