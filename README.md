SelfBank
 前言
==
SelfBank 是一个用php+js写的B/S个人(家庭)账务管理系统！
运行环境:php >=5.4, (nginx/apache/...),(Mysql/MariaDB)
安装前提:准备好web服务器，安装好数据库及php.当然，你还要有数据库的root账号及密码

-----

 安装(Install)
-
 其实只用安装数据文件即可，可以用install.php进行安装。也可以到数据库中用source 导入selfbank.sql
 1.git clone https://github.com/ymc023/selfbank.git or Download selfbank.zip
 2.cp -rf selfbank/ /var/www/....  //copy php源文件到www或其他自定义路径下
 3.vi selbank/config.php
  $db_servername="localhost";//Mysql服务器地址 
  $db_username="root";//数据库用户名 
  $db_password="$@albck$#－*723";//数据库密码 
  $db_dbname="selfbank";//数据库
  $qianzui="selfbank_";//表前缀
 4.配置好web服务，打开http://serverip or domainname/install.php
 5.系统默认会创建selfbank账号与密码，请更新到config.php中。不介意也可以用root
-


Usage
-
`rm [OPTION]...FILE...`



COPYRIGHT
---------
Copyright (C) 2013, Ahmed Abdel Razzak. All rights reserved.

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the
Free Software Foundation; version 2 of the License.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 59
Temple Place, Suite 330, Boston, MA 02111-1307 USA or see http://www.gnu.org/licenses/.

<?php
date_default_timezone_set("PRC");
//数据库配置信息，根据情况修改，否则无法安装
$db_servername="localhost";//Mysql服务器地址 
$db_username="root";//数据库用户名 
$db_password="SfcCq@123$";//数据库密码 
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
