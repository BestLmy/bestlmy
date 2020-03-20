<?php
require_once("dbConfig.php");
include_once("login.php");
$op='default';
if(isset($_GET["op"])) $op=$_GET["op"];
if($flag==1){
if(isset($_SESSION["uid"])&&isset($_SESSION["id"])){
    if($_SESSION["uid"]==0&&$_SESSION["id"]=='admin')
    $id=$_SESSION["id"];
}else die("请先登录即将跳转！<meta   http-equiv ='refresh' content=1;url='index.html'>");
}else die("数据库连接失败！<meta http-equiv='refresh' content=1;url='index.html'>");
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>用户密码管理系统管理员界面</title>
<link href="css/main_style.css" rel="stylesheet" type="text/css" />
<script type="text/JavaScript"> 
function gothere(){
    location.href = "./logout.php";
}
function operate(variable,variable1){
    if(variable=='del'){
        var check=confirm("确定要删除该用户吗?");
        if(check==true) window.location.href="operate.php?uid="+variable1+"&operate="+variable;
    }
    if(variable=='changepwd'){
        var pass1=prompt("请输入要修改的密码");
        if(pass1!=null)
        window.location.href="operate.php?uid="+variable1+"&operate="+variable+"&pass="+pass1;
}
    if(variable=='changephone'){
        var phone=prompt("请输入要修改的手机号");
        if(phone!=null)
        window.location.href="operate.php?uid="+variable1+"&operate="+variable+"&phone="+phone;
}
}
</script>
</head>

<body>
<div class="header">
	<div class="header03"></div>
	<div class="header01"></div>
	<div class="header02">用户密码管理系统管理员界面</div>
</div>
<div class="left" id="LeftBox">
	<div class="left01">
		<div class="left01_right"></div>
		<div class="left01_left"></div>
		<div class='left01_c'>欢迎您，管理员<?php echo $id;?></div>
	</div>
	<div class="left02">
		<div class="left02top">
			<div class="left02top_right"></div>
			<div class="left02top_left"></div>
			<div class="left02top_c">操作类别</div>
		</div>
	  <div class="left02down">
          <div class='left02down01'><div id='Bf080' class='left02down01_img'></div><a href='control.php?op=default'>查看全部用户信息</a></div>
          <div class='left02down01'><div id='Bf080' class='left02down01_img'></div><a href='control.php?op=statistics'>密码数据统计</a></div>
		</div>
	</div>
	<div class="left01">
		<div class="left03_right" style="cursor:pointer" onclick="gothere()" href="javascript:;"></div>
		<div class="left01_left"></div>
		<div class="left03_c" style="cursor:pointer;" onclick="gothere()" href="javascript:;">安全退出</div>
	</div>
</div>


<div class="rrcc" id="RightBox">
	<div class="right" id="li010">
		<div class="right01"><img src="img/04.gif" /> 管理员功能>>
    
    
<?php
        if($op=='default'){
        $content="select user_account,user_phonenum,uid from user ORDER BY uid desc";
        $result=mysqli_query($conn,$content);
        $RowNum=mysqli_num_rows($result);
        echo "<table id='customers' >
        <tr>
            <th>用户账号</th>
            <th>用户手机号</th>
            <th>用户id</th>
            <th>用户存储类型数</th>
            <th>用户存储密码数</th>
            <th>操作</th>
        </tr>";
        for($i=0; $i<$RowNum-1; $i++){
                    $row2= mysqli_fetch_assoc($result);
                    $arr[$i][0]=$row2["user_account"];
                    $array= $arr[$i][0];
                    if($array=="") $array='null';
                    $arr[$i][1]=$row2["user_phonenum"];
                    $pass=$arr[$i][1];
                    $arr[$i][2]=$row2["uid"];
                    $uid1=$arr[$i][2];
                    $content1="select COUNT(DISTINCT type) from passwd where uid='".$uid1."'";
                    $content2="select COUNT(password) from passwd where uid='".$uid1."'";
                    $result1=mysqli_query($conn,$content1);
                    $result2=mysqli_query($conn,$content2);
                    $row3= mysqli_fetch_assoc($result1);
                    $row4= mysqli_fetch_assoc($result2);
                    $arr[$i][3]=$row3["COUNT(DISTINCT type)"];
                    $arr[$i][4]=$row4["COUNT(password)"];
                    echo "<tr>";
                    echo "<td>{$arr[$i][0]}</td>";
					echo "<td>{$arr[$i][1]}</td>";
                    echo "<td>{$arr[$i][2]}</td>";
                    echo "<td>{$arr[$i][3]}</td>";
                    echo "<td>{$arr[$i][4]}</td>"; 
                    echo "<td><button type='button' onclick=operate('del','$uid1')>删除用户</button>";
                    echo "<button type='button' onclick=operate('changepwd','$uid1')>修改密码</button>";
                    echo "<button type='button' onclick=operate('changephone','$uid1')>修改手机号</button></td></tr>";
                    }
                }else if($op=='statistics'){
                    function testPassword($password)
                        {
                            if ( strlen( $password ) == 0 )return 1;
                            $strength = 0;
                            $length = strlen($password);
                            if(strtolower($password) != $password)  $strength += 1;//全是小写
                            if(strtoupper($password) == $password) $strength += 1;//全是大写
                            if($length >= 8 && $length <= 15)$strength += 1; //长度大于8
                            if($length >= 16)$strength += 2;//长度大于16
                            preg_match_all('/[0-9]/', $password, $numbers);//纯数字
                            $strength += count($numbers[0]);
                            preg_match_all('/[|!@#$%&*\/=?,;.:\-_+~^\\\]/', $password, $specialchars);//特殊字符
                            $strength += sizeof($specialchars[0]);   
                            $chars = str_split($password);
                            $num_unique_chars = sizeof( array_unique($chars) );
                            $strength += $num_unique_chars * 2;
                            $strength = $strength > 99 ? 99 : $strength;
                            $strength = floor($strength / 10 + 1);
                            return $strength;
                        }
                        $testsql="select AES_DECRYPT(`password`,'abc')  from passwd ORDER BY AES_DECRYPT(`password`,'abc') DESC";
                            $result=mysqli_query($conn,$testsql);
                            $RowNum=mysqli_num_rows($result);
                            echo "<table id='customers' >
                                <tr>
                                    <th>密码强度为1的数量</th>
                                    <th>密码强度为2的数量</th>
                                    <th>密码强度为3的数量</th>
                                    <th>密码强度为4的数量</th>
                                    <th>密码强度为5的数量</th>
                                    <th>密码强度为6的数量</th>

                                </tr>
                               ";
                                for($i=0;$i<=10;$i++) $a[$i]=0;
                                for($i=0; $i<$RowNum; $i++){
                                    $row= mysqli_fetch_assoc($result);
                                    $arr[$i]=$row["AES_DECRYPT(`password`,'abc')"];
                                    $b=testPassword($arr[$i]);
                                    $a[$b]++;
                                }
                                    echo "<tr>";
                                    echo "<td>{$a[1]}</td>";
                                    echo "<td>{$a[2]}</td>";
                                    echo "<td>{$a[3]}</td>";
                                    echo "<td>{$a[4]}</td>";
                                    echo "<td>{$a[5]}</td>"; 
                                    echo "<td>{$a[6]}</td>"; 
                                    echo "</tr>";
                                }
                        
                

?>
</table>
</div>
</div>
</body>
</html>