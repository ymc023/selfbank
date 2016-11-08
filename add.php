<?php
    date_default_timezone_set('PRC');
    include_once("top.php");
?>
<?php
$income=0;
$spending=0;
//submit按键执行
if($_GET[Submit]){
        $time100=($_GET[time]);
        $money=($_GET[money]);
        $time=date('h:i:s',time());
        if (empty($money)){  //防止不输入值直接提交
            echo "<script> alert('还没输入金额!');</script>";
        }
        else{
         $sql="insert into selfbank_account (acmoney, acclassid, actime, acremark,jiid,zhifu) values ('$_GET[money]', '$_GET[classid]', '$time100 $time', '$_GET[remark]', '$_SESSION[uid]', '0')";
         $query=mysql_query($sql);
	  if($query)
                { echo "<script> alert('添加账目成功!');window.location.href='index.php'</script>";
                 }
	  else
               { echo "<script> alert('添加账目失败!');window.location.href='index.php'</script>";}
        }
      }

?>
 <table align="center" width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#B3B3B3">
      <tr width="100%" align="left">
        <td width="50%" align="center" bgcolor="#EBEBEB">收入</td> 
        <td width="50%" align="center" bgcolor="#EBEBEB">支出</td>
      </tr>
      <tr>
        <td width="50%" align="center" bgcolor="#FFFFFF">
        <form id="form1" name="form1" method="get" action="">
         <label>收入金额：<input name="money" type="text" id="money" value="" size="8" /></label>
         <label>&nbsp; 收入分类：
            <select name="classid" id="classid">
            <?php
		  	$sql="select * from selfbank_account_class where classtype=1 and ufid='$_SESSION[uid]'";
			$query=mysql_query($sql);
			while($acclass=mysql_fetch_array($query)){
				echo "<option value='$acclass[classid]'>$acclass[classname]</option>";
			}
		  ?>
             </select>  </label>
          <label> 收入描述：<input name="remark" type="text" id="remark" /></label>
          <label> 日期: <input type="date" name="time" id="time" value="<?php $sz=date("Y-m-d");;echo "$sz";?>"/> </label>
          <input  name="Submit" type="submit" id="Submit" value="记账" /> 
          </form>
         </td>
         <td width="50%" align="center" bgcolor="#FFFFFF">           
         <form id="form1" name="form1" method="get" action="">
          <label>支出金额：<input name="money" type="text" id="money" size="8" /></label>
          <label>&nbsp; 支出分类：
            <select name="classid" id="classid">
              <?php
		  	$sql="select * from selfbank_account_class where classtype=2 and ufid='$_SESSION[uid]'";
			$query=mysql_query($sql);
			while($acclass=mysql_fetch_array($query)){
				echo "<option value='$acclass[classid]'>$acclass[classname]</option>";
			}
		  ?>
              </select> </label>
            <label>支出描述：<input name="remark" type="text" id="remark" /></label>
            <label>日期: <input type="date" name="time" id="time" value="<?php $sz=date("Y-m-d");;echo "$sz";?>"/> </label>
            <input  name="Submit" type="submit" id="Submit" value="记账" />
            </form>
	 </td>
       </tr>
      </table>

	<?php
			
		$sql="select * from selfbank_account where jiid='$_SESSION[uid]' ORDER BY actime ASC";
	        $query=mysql_query($sql);
		while($row = mysql_fetch_array($query)){
		$sql="select * from selfbank_account_class where classid= $row[acclassid] and ufid='$_SESSION[uid]'";
		$classquery=mysql_query($sql);
		$classinfo = mysql_fetch_array($classquery);
				
				if($classinfo[classtype]==1){
				 	
					$income=$income+$row[acmoney];
				}else{
					$spending=$spending+$row[acmoney];
				}    
			}
	
		  ?>


