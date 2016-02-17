<?php
date_default_timezone_set("PRC");
//数据库配置信息，根据情况修改，否则无法安装
$db_servername="localhost";//Mysql服务器地址 
$db_username="root";//数据库用户名 
$db_password="";//数据库密码 
$db_dbname="selfbank";//数据库
$qianzui="selfbank_";//表前缀
$conn=mysql_connect($db_servername,$db_username,$db_password);
if(indatabase($db_dbname,$conn)){
  mysql_select_db($db_dbname,$conn);
  mysql_query('SET NAMES utf8');
}

Function user_shell($uid,$shell)
{
  $sqlshell="SELECT * FROM `selfbank_user` WHERE `uid` = '$uid'";
  $query=mysql_query($sqlshell);
  $exist=is_array($row=mysql_fetch_array($query));
  $exist2=$exist?$shell==md5($row['username'].$row['password']):FALSE;
  if($exist2)
   {  return $row;  }
  else
   {  
    header("Location:login.php");
   exit();
    }
} 
   
   
date_default_timezone_set("Asia/Shanghai");

function user_mktime($onlinetime) {  $new_time = mktime();   if (($new_time - $onlinetime) > '900') {  session_destroy();   echo "登陆超时";  exit ();  } else {   $_SESSION['times'] = mktime();  }  } 


function indatabase($db_dbname,$conn){
  mysql_select_db("information_schema",$conn);
  $sql="select * from SCHEMATA where SCHEMA_NAME='".$db_dbname."'";
  $query=mysql_query($sql);
  $indb=is_array($row=mysql_fetch_array($query));
  return $indb;
}
function intable($dbname,$tablename,$conn){
  mysql_select_db("information_schema",$conn);
  $sql="select * from TABLE_CONSTRAINTS where TABLE_SCHEMA='".$dbname."' and TABLE_NAME='".$tablename."'";
  $query=mysql_query($sql);
  $intable=is_array($row=mysql_fetch_array($query));
  mysql_select_db($dbname,$conn);//重新关联账本数据库
  return $intable;
}

?>
