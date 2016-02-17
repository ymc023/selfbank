<?php
    include_once("top.php");
?>
<?php
         $sqlzhanghu = "SELECT * FROM selfbank_user where uid='$_SESSION[uid]'";
         $result2 = mysql_query($sqlzhanghu);
         $row = mysql_fetch_array($result2);
         ?>
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>

    <td width="100%"></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table align="center" width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
        <tr>
          <td bgcolor="#EBEBEB">　当前账号:  <?php echo $row[username]; ?> </td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF">
          
           <form action="" method="post" name="submitxiugai">
    <fieldset>
        <?php
         ?>
     <div>
     <div>
       <table>
       <tr>
        
        <label for="Email">Email:</label>  <input  name="email" id="email" value="<?php echo $row[email]; ?>"> 
        
        <label for="password">原密码:</label>
        <input type="password" name="jiupassword" id="jiupassword" size="18" maxlength="15" />
        <label for="password">新密码</label>
        <input type="password" name="password" id="password" size="18" maxlength="15" /> 
        *(最多15个字符)<br />

    </div>

     
        <div class="enter">
        <input name="Submitxiugai" type="submit" class="buttom" value="更改" /> 
        <?php 
        if($_POST[Submitxiugai]){   
         $jiumima=md5($_POST[jiupassword]);
 
      if($jiumima==$row[password]){
        if($_POST[password]<>""){
          $umima=md5($_POST[password]);
        }else{
          $umima=$jiumima;
        }
      $sql="update selfbank_user set password='$umima',email='$_POST[email]' where uid='$_SESSION[uid]'";
      $query=mysql_query($sql);
      if($query){
        echo "<script>alert('密码修改成功!请重新登录！');window.location.replace('login.php')</script>";
      }else{
        echo "<script>alert('更改密码失败!');window.location.replace('index.php')</script>";
    
        }
    }else{
            echo "<script>alert('密码不能为空或旧密码错误');window.location.replace('index.php')</script>";
      exit();
    }
    }
?>
    </div>
   
    </fieldset>
    </form>
          
          </td>
        </tr>
      </table>
      <table align="center" width="100%" height="15" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td></td>
        </tr>
      </table>


