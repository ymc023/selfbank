<?php
   include_once("top.php");
?>
<html>
 <title>Register on SelfBank</title>
 <body>
    <form action="" method="post" name="submitzhuce">
        <div>
        <label for="Name">账户名</label>
        <input type="text" name="username" id="username" value="" size="20" maxlength="30" /> 
        *(最多30个字符)<br />    
    </div>
        <div>
        <label for="Email">Email</label>
        <input type="text" name="email" id="email" value="" size="20" maxlength="150" onblur=isEmail(this.value) /> *<br />    
    </div>    
        <div>
        <label for="password">密码</label>
        <input type="password" name="password" id="password" size="18" maxlength="15" /> 
        *(最多15个字符)<br />
    </div>
        <div>
        <br />
    </div>
     
        <div class="enter">
        <input name="Submitzhuce" type="submit" class="buttom" value="注册" /> <?php if($_POST[Submitzhuce]){
        
        if ( empty($_POST[email])
|| !ereg("^[-a-zA-Z0-9_.]+@([0-9A-Za-z][0-9A-Za-z-]+\.)+[A-Za-z]{2,5}$",$_POST[email])
) {
echo "<script>alert('邮箱输入不正确!');window.location.replace('register.php')</script>";exit;

} 
        
  $sql="select * from selfbank_user where username='$_POST[username]' or email='$_POST[email]'";
  $query=mysql_query($sql);
  $attitle=is_array($row=mysql_fetch_array($query));
  if($attitle){
    echo "<script>alert('用户名已经存在，请更换一个吧!');window.location.replace('register.php')</script>";
    exit();
  }else{
        $umima=md5($_POST[password]);
  $sql="insert into selfbank_user (username, password,email,utime) values ('$_POST[username]', '$umima', '$_POST[email]', now())";
  $query=mysql_query($sql);
  if($query)
    echo "<script>alert('新用户注册成功!现在返回首页！');window.location.replace('index.php')</script>";
  else
    echo "<script>alert('注册失败!请查看服务器日志或数据库日志！');window.location.replace('register.php')</script>";
}
}
?>
    </div>
    </form>
    </body>
    </html>
