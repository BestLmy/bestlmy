<?php
require_once('control.php');
if(isset($_SESSION['uid'])&&$_SESSION['uid']==0){
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



    $password = 'php_tutorials_and_examples!12333333333333333';
    echo testPassword($password);
    echo "<table id='customers' >
        <tr>
            <th>用户账号</th>
            <th>用户手机号</th>
            <th>用户id</th>
            <th>用户存储类型数</th>
            <th>用户存储密码数</th>
            <th>操作</th>
        </tr>
        </table>";
}else die("<script>alert('请使用管理员身份操作!')</script><meta http-equiv ='refresh' content=0;url=control.php>");
?>