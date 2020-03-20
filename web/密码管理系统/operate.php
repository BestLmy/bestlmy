<?php
include_once('control.php');
if(isset($_SESSION['uid'])&&$_SESSION['uid']==0){
    if(isset($_GET['uid'])&&isset($_GET['operate'])){
        $ope=$_GET['operate'];
        $uid1=$_GET['uid'];
        if($ope=='del'){
            $delsql1="delete from passwd where uid=".$uid1;
            $delsql2="delete from user where uid=".$uid1;
            $result1=mysqli_query($conn,$delsql1);
            $result2=mysqli_query($conn,$delsql2);
            if(mysqli_affected_rows($conn)>=1){
                die("<script>alert('账号删除成功!')</script><meta http-equiv ='refresh' content=0;url=control.php>");
            }
        }

        
        if($ope=='changepwd'&&isset($_GET['pass'])){
            
            $changesql1="update user set user_pwd=md5('".$_GET['pass']."') where uid=".$uid1;
            $result=mysqli_query($conn,$changesql1);
            if(mysqli_affected_rows($conn)>=1){
                die("<script>alert('密码修改成功!')</script><meta http-equiv ='refresh' content=0;url=control.php>");
            }else die("<script>alert('密码修改失败!')</script><meta http-equiv ='refresh' content=0;url=control.php>");
            
        }//else die("<script>alert('参数错误!')</script><meta http-equiv ='refresh' content=0;url=control.php>");


        if($ope=='changephone'&&isset($_GET['phone'])){
            $changesql1="update user set user_phonenum=".$_GET['phone']." where uid=".$uid1;
            $result=mysqli_query($conn,$changesql1);
            if(mysqli_affected_rows($conn)>=1){
            die("<script>alert('手机号修改成功!')</script><meta http-equiv ='refresh' content=0;url=control.php>");
            }else die("<script>alert('手机号修改失败!')</script><meta http-equiv ='refresh' content=0;url=control.php>");
        }//else die("<script>alert('手机号修改失败!')</script><meta http-equiv ='refresh' content=0;url=control.php>");

    }else die("<script>alert('参数缺少uid或operate!')</script><meta http-equiv ='refresh' content=0;url=control.php>");


}else die("<script>alert('请使用管理员身份操作!')</script><meta http-equiv ='refresh' content=0;url=control.php>");


?>
