<?php
require_once "./dbConfig.php";
if($flag==1){
header('Content-type:text/html; charset=utf-8');
session_start();
if(isset($_POST["login_name"]) && isset($_POST["login_pwd"])){
	$id=$_POST["login_name"];
	$pass=md5($_POST["login_pwd"]);//id和pass赋值  passmd5加密
	$sql="select * from user where user_account='$id'";
	$result=mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	if($row["user_pwd"]==$pass){
		$uid=$row["uid"];
		$_SESSION["uid"] = $uid;
		$_SESSION["id"]=$row["user_account"];
		if($uid==0){
			echo "欢迎您管理员!即将跳转";
			die("<meta   http-equiv ='refresh' content=1;url='control.php'>");
		}
		if($uid==42){
			echo "你好，猪~";
			$sqlq="select * from record";
			$result1=mysqli_query($conn,$sqlq);
			$row1 = mysqli_fetch_assoc($result1);
			echo "你上次来的时间是".$row1['time'].",你已经来了".$row1['num']."次了，爱你哦";
			$sqlq="update record set time=DATE_FORMAT(NOW(),'%Y-%m-%d')";
			$result1=mysqli_query($conn,$sqlq);
			$sqlq="update record set num=num+1";
			$result1=mysqli_query($conn,$sqlq);
			die("<meta   http-equiv ='refresh' content=2;url='src\main\webapp\index.html'>");
		}	
		echo "登录成功!即将跳转";
		echo "<meta   http-equiv ='refresh' content=1;url='main.php'>";
	}else{
		echo "<script>alert('账号或密码错误!')</script>";
		echo "<meta   http-equiv ='refresh' content=0;url='index.html'>";	
	}
	}
}else echo "服务器错误:数据库连接失败";
?>
你好，猪~
Warning: A non-numeric value encountered in C:\phpstudy_pro\WWW\design\login.php on line 25

Warning: A non-numeric value encountered in C:\phpstudy_pro\WWW\design\login.php on line 25

Warning: A non-numeric value encountered in C:\phpstudy_pro\WWW\design\login.php on line 25
2025