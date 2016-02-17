<?php
session_start();
?>
<?php
  if($_GET['tj'] == 'logout'){
  session_start(); //开启session
  session_destroy();  //注销session
  header("location:login.php"); //跳转到首页
  }
?>
<!DOCTYPE HTML>
<html>
<head>  
<meta charset="UTF-8">
<meta name="top" content="SelfBank" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" type="text/css" href="css/top.css"> 
<link rel="stylesheet" type="text/css" href="css/top1.css"> 
<title>SelfBank</title>
</head>

<body>
<?php
include("config.php");
$arr=user_shell($_SESSION['uid'],$_SESSION['user_shell']);//对权限进行判断
?>
<div id="navigater">
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<div class="navbar navbar-fixed-top">
	<div class="navbar-inner spring">
		<div class="container">
			<ul class="nav">
                        <li class="active">
			  <a href="index.php" class="brand">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSelfBank</a>
		         </li>

				<li index="index">
					<a href="index.php">首页</a>
				</li>
                               

				<li index="more">
                                       <a href="http://github.com/ymc023" target="_blank">更多产品</a> 
				</li>

				<li index="class">
					<a href="account_class.php">新建账务类型</a> 
				</li>
				<li index="jizhang">
					<a href="add.php">记流水账</a> 
				</li>

				<li index="change">
					<a href="change.php">账目修改</a> 
				</li>
				<li index="class">
					<a href="view.php">账目查询</a> 
				</li>
				<li index="status">
                                <a href="user.php">
                                <?php echo"关于:";echo $arr['username'];?></a> 
				</li>
				<li index="register">
                                 <a href="register.php">注册新用户</a>
                                 </li>	
				<li index="logout">
                                 <a href="index.php?tj=logout">退出[Logout] </a>
                                 </li>	
			</ul>

		</div>

	</div>

</div>
				</div>
			</div>
		</div>
	
</body>
 
