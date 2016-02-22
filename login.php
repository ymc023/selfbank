<?php session_start();
#Author:ymc023
#Email:ymc023@163.com
#Date:2016.01.10
#Platform:Centos7+php+mysql+nginx
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>SelfBank Login</title>
<link rel="stylesheet" type="text/css" href="css/login.css" /> 
</style>
</head>
<body>
<?php include("config.php"); ?>

 <div class="container">
	<section id="content">
		<form action="" method="POST">
			<h1>Login on SelfBank</h1>
			<div>
				<input type="text" name="username" placeholder="Username" required="" id="username" />
			</div>
			<div>
				<input type="password" name="password" placeholder="Password" required="" id="password" />
			</div>
			<div>
				<input name="submit" type="submit" class="buttomm" value="登录" />		
			</div>
		</form><!-- form -->
</section><!-- content -->
</div>
           
          <?php
if($_POST['submit']){
  $username=str_replace(" ","",$_POST['username']);
   //去空格
     $sql="SELECT * FROM selfbank_user WHERE username = '$username'";
     $query=mysql_query($sql);
        $exist=is_array($row=mysql_fetch_array($query));
         //判断是否存在用户
            $exist2=$exist?md5($_POST['password'])==$row['password']:FALSE;
            //判断密码  
            if($exist2){
               $_SESSION['uid']=$row['uid'];
             // session赋值
                $_SESSION['user_shell']=md5($row['username'].$row['password']);
                    echo "<script>alert('登陆成功');</script>";
                    header("Location:index.php");
                 }
                 else{ 
                   echo "<script>alert('用户名或密码错误!');</script>"; 
                   SESSION_DESTROY(); 
                    } 
                  } ?>
        </div>    
    </form>
    <br />
</body>
</html>
