<?php
$host = 'localhost';
$user = 'root';
$pwd = 'windows2000';
$database = 'pwd';
$port = 3306;
$url="./check.html";
$check_list = "/into|load_file|0x|outfile|by|substr|base|echo|hex|mid|like|or|char|union|or|select|greatest|%00|_|\'|admin|limit|=_| |in|<|>|-|user|\(\)|#|and|if|database|where|concat|insert|having|sleep/i";
$conn =mysqli_connect($host,$user,$pwd,$database);
mysqli_set_charset($conn,"utf8");
if (mysqli_connect_errno($conn)) 
{ 
    echo "连接 MySQL 失败: " . mysqli_connect_error(); 
} else{
    $flag=1;
}
?>