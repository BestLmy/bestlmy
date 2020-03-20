<?php
require_once("dbConfig.php");
include_once("login.php");
if(isset($_GET["type"])) $type=$_GET["type"];
else $type="xxx";
$url1="./index.html";
if($flag==1){
if(isset($_SESSION["uid"])&&isset($_SESSION["id"])){
    $uid=$_SESSION["uid"];
    $id=$_SESSION["id"];
    $sql="select * from passwd where uid = '$uid'";
    $typenumsql="select COUNT(DISTINCT type) from passwd where uid = '$uid'";
    $result=mysqli_query($conn,$typenumsql);
    $row = mysqli_fetch_assoc($result);
    $typenum=$row["COUNT(DISTINCT type)"];
}else die("请先登录即将跳转！<meta   http-equiv ='refresh' content=2;url=$url1>");
}else die("数据库连接失败！<meta http-equiv='refresh' content=2;url=$url1>");
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>用户密码管理系统</title>
<link href="css/main_style.css" rel="stylesheet" type="text/css" />
<script type="text/JavaScript"> 

function gothere(){
    location.href = "./logout.php";
}
function addtype(){
    var type=prompt("请输入添加的类型名");
	if(type!='')
    window.location.href="addtype.php?type="+type;
}

function getQueryVariable(variable)
{
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}
function change(variable,variable1){
    alert(variable);
    var type=getQueryVariable("type");
    var accou=window.confirm("要修改账号吗?");
    if (accou==true) {
        var accou1=prompt("请输入要修改的账号名");
        if(accou1!=null)
        window.location.href="change.php?account="+accou1+"&type="+type+"&imp="+variable1;
    }else{
    var pass=confirm("要修改密码吗?");
    if(pass==true){
        var pass1=prompt("请输入要修改的密码");
        if(pass1!=null)
        window.location.href="change.php?passwd="+pass1+"&type="+type+"&accoun="+variable+"&imp="+variable1;
    }else{
    var note=confirm("要修改备注吗?");
    if(note==true){
        var note1=prompt("请输入要修改的备注");
        if(note1!=null)
        window.location.href="change.php?note="+note1+"&type="+type+"&accoun="+variable+"&imp="+variable1;
        }else alert("???什么都不改？");
    }
}
}
function add(){
        var type=getQueryVariable("type");
        var account=prompt("请输入要添加的账号");
        var pass=prompt("请输入要添加的密码");
        var note=prompt("请输入要添加的备注");
        window.location.href="add.php?note="+note+"&type="+type+"&account="+account+"&pass="+pass;
}
function changeimp(variable,variable1,variable2,variable3){
    var type=getQueryVariable("type");
    if(variable=="up") variable1+=1;
    if(variable=='down') variable1-=1;
    window.location.href="changeimp.php?type="+type+"&account="+variable2+"&pass="+variable3+"&imp="+variable1;
}
function del(variable){
    window.location.href = variable;
}
function search(){
    var type=getQueryVariable("type");
    var via=prompt("请输入要查找的账号名(支持模糊查询)");
	if(via!='')  window.location.href="main.php?type="+type+"&search="+via;
}
</script>
</head>

<body>
<div class="header">
	<div class="header03"></div>
	<div class="header01"></div>
	<div class="header02">用户密码管理系统</div>
</div>
<div class="left" id="LeftBox">
	<div class="left01">
		<div class="left01_right"></div>
		<div class="left01_left"></div>
		<div class='left01_c'>欢迎您，用户<?php echo $id;?></div>
	</div>
	<div class="left02">
		<div class="left02top">
			<div class="left02top_right"></div>
			<div class="left02top_left"></div>
			<div class="left02top_c">密码信息类别</div>
		</div>
	  <div class="left02down">
          <?php
            $type1="select DISTINCT type from passwd where uid = '$uid'";
            $result=mysqli_query($conn,$type1);
                for($i=0;$i<$typenum;$i++){
                    $row1 = mysqli_fetch_assoc($result);
                    echo " <div class='left02down01'><div id='Bf080' class='left02down01_img'></div><a href='./main.php?type=$row1[type]'>$row1[type]</a></div>";
                }
          ?>
          <div class='left02down01'><div id='Bf080' class='left02down01_img'></div> <a onclick="addtype()" href="javascript:;">添加类别</a></div>
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
		<div class="right01"><img src="img/04.gif" /> 详细密码查询>><span style="cursor:pointer;" onclick="add()" href="javascript:;">添加一行新的密码信息(不要出现汉字)---</span>
        <span style="cursor:pointer;" onclick="search()" href="javascript:;">---查询账号</span></div>
    
    <table id="customers" >
        <tr>
            <th>账号</th>
            <th>密码</th>
            <th>备注</th>
            <th>删除</th>
            <th>修改</th>
            <th>重要级</th>
        </tr>
<?php
        $content="select account,AES_DECRYPT(password,'abc'),note,importance from passwd where uid = '$uid' and type='".$type."' ORDER BY importance desc";
        if(isset($_GET["search"])) {
            $search=$_GET["search"];
            $content="select account,AES_DECRYPT(password,'abc'),note,importance from passwd where uid = '$uid' and type='".$type."' and `account` LIKE '%".$search."%' ORDER BY importance desc";
            }
                $result=mysqli_query($conn,$content);
        $RowNum=mysqli_num_rows($result); 
        for($i=0; $i<$RowNum; $i++){
                    $row2= mysqli_fetch_assoc($result);
                    $arr[$i][0]=$row2["account"];
                    $array= $arr[$i][0];
                    if($array=="") $array='null';
                    $arr[$i][1]=$row2["AES_DECRYPT(password,'abc')"];
                    $pass=$arr[$i][1];
                    $arr[$i][2]=$row2["note"];
                    $arr[$i][3]=$row2["importance"];
                    $imp=$arr[$i][3];
					echo "<tr>";
                    echo "<td>{$arr[$i][0]}</td>";
					echo "<td>{$arr[$i][1]}</td>";
                    echo "<td>{$arr[$i][2]}</td>";
                    $del="delete.php?account=".$array."&type=".$type;   
                    echo "<td><button type='button' onclick=del('$del')>删除</button></td>";
                    echo "<td><button type='button' onclick=change('$array',$imp)>修改</button></td>";
                    echo "<td> {$arr[$i][3]}
                    <button type='button' onclick=changeimp('up',$imp,'$array','$pass')>增加</button>
                    <button type='button' onclick=changeimp('down',$imp,'$array','$pass')>减少</button></td>";
					echo "</tr>";
					}

?>
</table>
</div>
</div>
<footer>
        <p style="color: green;">© Lmy Lcq  ECJTU 2019-12-29</p>
    </footer>
</body>
</html>