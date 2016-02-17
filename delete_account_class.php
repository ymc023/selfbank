<?php
    include_once("top.php");
?>
<html>
<table align="center" width="640" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="40" height="25">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="40" height="85">&nbsp;</td>
    <td align="left" valign="top">
    <?php
        //查询当前分类信息
        $sql="select * from selfbank_account_class where classid='$_GET[classid]' and ufid='$_SESSION[uid]'";
        $query=mysql_query($sql);
        $cuclass = mysql_fetch_array($query);
        //修改分类名称
        if($_GET[Submit]){
          $sql="update selfbank_account_class set classname= '$_GET[classname2]' where classid='$_GET[classid]' and ufid='$_SESSION[uid]'";
          $query=mysql_query($sql);
                 if ($query){
                 echo "<script>alert('修改成功!');window.location.replace('account_class.php');</script>"; 
                 exit();
                 }else{                                                                                                                                             echo "<script>alert('修改失败!');window.location.replace('account_class.php');</script>"; 
                     exit(); }
        }
        //删除分类
		if($_GET[Submit3]){
			$sql="select * from selfbank_account where acclassid='$_GET[classid]' and jiid='$_SESSION[uid]'";
			$query=mysql_query($sql);
			if($row=mysql_fetch_array($query)){
                                echo "<script>alert('只能删除没有账目的空账务类型!');window.location.replace('account_class.php');</script>"; 
				exit();
			}else{
				$sql="delete from selfbank_account_class where classid=".$_GET[classid];
				if(mysql_query($sql))
                                    echo "<script>alert('删除成功!');window.location.replace('account_class.php');</script>"; 
				else
                                   echo "<script>alert('删除失败!数据库返回异常');window.location.replace('account_class.php');</script>"; 
				exit();
			}
		}
            
               if($_GET[type]=="1")
               { 
                 ?>
                  <table align="center" width="600" border="0" cellpadding="0" cellspacing="0">
                   <tr>
                  <td><form id="form1" name="form1" method="get" action="">
                  <label>将[<font color="#FF0000"><?php echo $cuclass[classname]; ?></font>]修改</label>
                   为
                  <input name="classname2" type="text" id="classname2" value="<?php echo $cuclass[classname]; ?>" />
                   </label>
                    <label>
                  <input type="submit" name="Submit" value="修改" />
                   </label>
                     <input name="classid" type="hidden" id="classid" value="<?php echo $_GET[classid]; ?>" />
                  </form>
                   </td>
                    </tr>
                    </table>
	  <?php
		//根据操作判断要显示内容
               }elseif($_GET[type]=="3"){
	  ?>
      <table align="center" width="600" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>只能删除空的账务类型名称!(即没有账目)，否则无法删除!</td>
        </tr>
        <tr>
          <td><form id="form3" name="form3" method="get" action="">
            <label>
              <input type="submit" name="Submit3" value="删除" />
              </label>
            <input name="classid" type="hidden" id="classid" value="<?=$_GET[classid]?>" />
          </form>
          </td>
        </tr>
      </table>
	  <?php
	  	}else{
                                echo "参数错误";
		}
	  ?>
    </td>
  </tr>
</table>
</hmtl>
