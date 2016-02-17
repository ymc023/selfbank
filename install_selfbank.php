<html>
<head>
<meta charset="UTF-8">
<link rel="styleshee" type="text/css" href="css/top.css">
<link rel="stylesheet" type="text/css" href="css/top1.css">
<title>SelfBank Install</title>
<body>

<?php
date_default_timezone_set("PRC");
mysql_query("set NAMES 'utf8'");
mysql_query("set character_set_client=utf8");
mysql_query("set character_set_results=utf8");

include("config.php");
echo "开始创建数据库selfbank......<br/>";
if(indatabase($db_dbname,$conn)){
	echo "已经存在数据库".$db_name."，跳过...<br /><br/>";
}else{
mysql_query("set NAMES 'utf8'");
mysql_query("set character_set_client=utf8");
mysql_query("set character_set_results=utf8");
	$sql = "create database ".$db_dbname." default character SET utf8 COLLATE utf8_general_ci;";
	$query=mysql_query($sql);
	if($query){
		echo "创建库".$db_dbname."成功!<br /><br/>";
                $returndb='1';
	}else{
		echo "创建库".$db_name."失败! <br /><br/>";
		
	}
}

echo "开始创建表selfbank_account ......<br />";
if(intable($db_dbname,"selfbank_account",$conn)){
	echo "数据表selfbank_account"."已存在<br /><br/>";
	
}else{
mysql_query("set NAMES 'utf8'");
mysql_query("set character_set_client=utf8");
mysql_query("set character_set_results=utf8");
   $sql="CREATE TABLE `$db_dbname`.`selfbank_account` ( 
  `acid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `acmoney` decimal(10,2) NOT NULL,
  `acclassid` int(8) NOT NULL,
  `actime` datetime NOT NULL,
  `acremark` varchar(50) NOT NULL,
  `jiid` int(8) NOT NULL,
  `zhifu` int(8) NOT NULL,
  PRIMARY KEY (`acid`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;";
  $query=mysql_query($sql);
	if($query){
	echo "Create table selfbank_account 成功!<br /><br/>";
        $returnk1='1';
	}else{
		#echo $sql;
		echo "create table selfbank_account 失败!请检查config.php相关配置<br /><br/>";
		
	}
}
echo "开始创建表 selfbank_account_class ......<br/>";
if(intable($db_dbname,"selfbank_account_class",$conn)){
	echo "已经安装过啦，表selfbank_account_class已经存在 <br/><br/>";
	
}else{
mysql_query("set NAMES 'utf8'");
mysql_query("set character_set_client=utf8");
mysql_query("set character_set_results=utf8");
	$sql = "CREATE TABLE `$db_dbname`.`selfbank_account_class` (
  `classid` int(5) NOT NULL AUTO_INCREMENT,
  `classname` varchar(20) NOT NULL,
  `classtype` int(1) NOT NULL,
  `ufid` int(8) NOT NULL,
  PRIMARY KEY (`classid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;";
	$query=mysql_query($sql);
	if($query){
	echo "create table selfbank_account_class 成功!<br /><br/>";
        $returnk2='1';
	}else{
		echo "create table selfbank_account_class失败!请检查config.php相关配置 <br/><br/>";
		
	}
}
echo "开始创建系统样本账务数据......<br/>";
$sql="INSERT INTO `selfbank_account_class` VALUES (1,'采购成本',2,1),(2,'客户确认回款',1,1),(3,'利润转账',2,1),(13,'日常支出',2,1),(14,'交通费用',2,1),(15,'人情往来',2,1),(16,'景区门票',2,1),(17,'工资到账',1,1);";
mysql_query("set NAMES 'utf8'");
mysql_query("set character_set_client=utf8");
mysql_query("set character_set_results=utf8");
$query=mysql_query($sql);
    if($query){
	  echo "创建样本账务数据成功! <br /><br/>";
          $returnk3='1';
    }else{
	  echo "创建样本账务数据失败了!<br /><br/>";
}


echo "开始创建表 selfbank_user .....<br/>";
if(intable($db_dbname,$qianzui."user",$conn)){
	echo "已经安装过啦，表selfbank_user已经存在! <br/><br/>";
	
}else{
mysql_query("set NAMES 'utf8'");
mysql_query("set character_set_client=utf8");
mysql_query("set character_set_results=utf8");
	$sql = "CREATE TABLE `$db_dbname`.`selfbank_user` (
  `uid` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(35) NOT NULL,
  `email` varchar(20) NOT NULL,
  `utime` datetime NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;";
	$query=mysql_query($sql);
	if($query){
	echo "create table selfbank_user 成功!<br /><br>";
        $returnk4='1';
	}else{
		echo "create table selfbank_user失败!请检查config.php相关配置<br /><br>";
	}
}



echo "开始创建系统默认用户.....<br/>";
$sql="select * from `db_dbname`.`selfbank_user` where username='admin'";
	$query=mysql_query($sql);
	$attitle=is_array($row=mysql_fetch_array($query));
	if($attitle){
		echo "默认用户已存在！<br /><br>";
		exit();
	}else{	
    $sql="INSERT INTO `$db_dbname`.`selfbank_user` VALUES (1,'admin','a3175a452c7a8fea80c62a198a40f6c9','admin@selfbank.com',now());";
    $query=mysql_query($sql);
    if($query){
	  echo "用户admin可以使用了！默认密码是admin@admin <br />";
          $returnk5='1';
    }else{
	  echo "加入默认用户admin失败了!<br /><br/>";
}
}



echo "开始创建存储过程.....<br/>";
$sql="CREATE PROCEDURE `summoney`(in fenlei int,in yue varchar(50),in userid int,out result decimal(10,2))
begin select sum(`acmoney`) INTO result from `selfbank_account` where acclassid=fenlei and actime like yue and jiid=userid; end ;
";
	$query=mysql_query($sql);
    if($query){
	  echo "创建存储过程summoney成功！ <br />";
          $returnk7='1';
    }else{
	  echo "创建存储过程失败了!<br /><br/>";
}



echo "开始创建库连接账户.....<br/>";
    $sql="grant all privileges on selfbank.* to selfbank@localhost identified by 'selfbank';";
    $query=mysql_query($sql);
    if($query){
	  echo "创建数据库用户selfbank成功，请将config.php中账户修改为selfbank,selfbank <br />";
          $returnk6='1';
    }else{
	  echo "创建selfbank账户失败了!可能是没有创建数据库用户的权限!<br /><br/>";
}


if ($returndb==='1'&&$returnk1==='1'&&$returnk2==='1'&&$returnk3==='1'&&$returnk4==='1'&&$returnk5==='1'&&$returnk6==='1'&&$returnk7==='1')
{
        echo "<script>alert('安装完成，使用账号:admin 密码:admin@admin登录!');window.location.href='login.php'</script>";
}
else
{
        echo "<script>alert('安装失败!请检查config.php文件!');window.location.href='install.php'</script>";
}
?>
</body>
</html

